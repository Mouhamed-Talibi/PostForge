<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PostCreationRequest;
    use App\Http\Requests\PostSearchRequest;
    use App\Models\Category;
    use App\Models\Creator;
    use App\Models\Post;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\DB;

    class PostController extends Controller
    {
        use AuthorizesRequests;

        /**
         * Display a listing of the resource.
         */
        public function index(){
            $acceptedPosts = Post::with(['category', 'creator', 'likers'])
                ->withCount('likers')
                ->where('status', 'accepted')
                ->latest()
                ->paginate(10);
            
            return view('posts.index', compact('acceptedPosts'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            // authorize creation 
            $this->authorize('create', auth('creator')->user());

            // getting categories
            $categories = Cache::remember('categories', 3600, function () {
                return Category::orderByDesc('name')->get();
            });

            Cache::forget('categories');
            return view('posts.create', compact('categories'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(PostCreationRequest $request)
        {
            // authorize creation
            $this->authorize('create', auth('creator')->user());

            // getting creator id
            $creatorId = auth('creator')->id();

            // creator pending posts 
            $pendingPosts = Post::where('creator_id', $creatorId)
                ->where('status', 'pending')
                ->count();
            // allow creating if posts less than 5
            if ($pendingPosts >= 5) {
                return redirect()
                    ->route('posts.myposts')
                    ->with('error', 
                    'You have reached the maximum limit of pending posts (5). Please wait for approval before creating new posts.');
            }

            $validatedFields = $request->validated();
            // handling image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = date('Ym') . "_" . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('uploads/posts/images', $imageName, 'public');
                $validatedFields['image'] = $imagePath;
            } else {
                $validatedFields['image'] = 'uploads/posts/images/posts-default-image.png';
            }

            // create post 
            $isCreated = Post::create([
                'title' => $validatedFields['post_title'],
                'slug' => str_replace(' ', '-', $validatedFields['post_title']),
                'description' => $validatedFields['description'],
                'creator_id' => auth('creator')->id(),
                'category_id' => $validatedFields['category'],
                'image' => $validatedFields['image'] ?? null,
            ]);

            // redirecting to my posts page ( after creating post )
            if ($isCreated) {
                return redirect()->route('posts.myposts')->with('success', 'Your Post Is created successfully');
            } else {
                return redirect()->back()->with('error', "Failed to create post, Please try Again !");
            }
        }

        /**
         * Display the specified resource.
         */
        public function show(Post $post)
        {
            $cachedPost = Cache::remember('post_' . $post->id, 3600, function() use ($post) {
                return Post::with('category')->findOrFail($post->id);
            });
            return view('posts.show', compact('cachedPost'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Post $post)
        {
            // authorize edit
            $this->authorize('edit', $post);
            $post = Post::with('category')->findOrFail($post->id);
            $categories = Category::orderByDesc('name')->get();
            return view('posts.edit', compact(['post', 'categories']));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(PostCreationRequest $request, Post $post)
        {
            // authorize update
            $this->authorize('update', $post);
            $validatedFields = $request->validated();

            // handling case new image uploaded
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = date('Ym') . "_" . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('uploads/posts/images', $imageName, 'public');
                $validatedFields['image'] = $imagePath;
            }

            // updating the post 
            $post->update([
                'title' => $validatedFields['post_title'],
                'slug' => str_replace(" ", "-",  $validatedFields['post_title']),
                'description' =>  $validatedFields['description'],
                'category' =>  $validatedFields['category'],
                'image' =>  $validatedFields['image'],
            ]);

            // clearing cache
            Cache::forget('post_' . $post->id);

            // redirecting with success message 
            return redirect()
                ->route('posts.show', $post->id)
                ->with('success', 'Your Post updated successfully');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Post $post)
        {
            // authorize delete
            $this->authorize('delete', $post);

            // checking if post is created by current user
            if ($post->creator_id != auth('creator')->id()) {
                return redirect()->back()->with('error', 'You are not authorized to delete this post.');
            }

            // delete post by creator 
            try {
                $post->delete();
                return redirect()
                ->route('posts.myposts')
                ->with('success', 'Your Post deleted successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to delete post. Please try again.');
            }
        }

        // my posts method 
        public function myPosts(){
            $creator = auth('creator')->user();
            $cacheKey = 'creator_posts_' . $creator->id;

            // Using the relationship with eager loading and caching
            $creatorPosts = Cache::remember($cacheKey, now()->addHours(1), function() use ($creator) {
                return $creator->posts()
                            ->with('category') // Eager load category
                            ->latest() // Same as orderBy('created_at', 'desc')
                            ->get();
            });

            Cache::forget($cacheKey);
            return view('posts.myPosts', compact('creatorPosts'));
        }

        // search posts method
        public function search(PostSearchRequest $request) {
            // authoriz search
            $this->authorize('search', auth('creator')->user());

            // find relasted Posts
            $validatedTitle = $request->validated();

            $relatedPosts = Post::where('title', 'like', '%' . $validatedTitle['title'] . '%')
                ->paginate(5);

            // check if not empty related posts 
            if ($relatedPosts->isEmpty()) {
                return redirect()->back()->with('error', 'No posts found.');
            } else {
                return view('posts.search', compact('relatedPosts'))
                    ->with('success', 'Posts found successfully :)');
            }
        }

        // like post
        public function like(Post $post){
            $creator = auth('creator')->user();
            
            // Check if already liked
            if ($creator->likedPosts()->where('post_id', $post->id)->exists()) {
                return response()->json([
                    'message' => 'Already liked',
                    'likes_count' => $post->likes_count
                ], 422);
            }

            // Add like
            $creator->likedPosts()->attach($post->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return response()->json([
                'message' => 'Post liked',
                'likes_count' => $post->fresh()->likes_count
            ]);
        }

        // unlike post
        public function unlike(Post $post){
            $creator = auth('creator')->user();
            
            // Remove like
            $creator->likedPosts()->detach($post->id);
            
            return response()->json([
                'message' => 'Post unliked',
                'likes_count' => $post->fresh()->likes_count
            ]);
        }
    }

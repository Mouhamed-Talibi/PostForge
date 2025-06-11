<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PostCreationRequest;
    use App\Models\Category;
    use App\Models\Post;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\DB;

    class PostController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            return view('posts.index');
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $categories = Cache::remember('categories', 3600, function () {
                return Category::orderByDesc('name')->get();
            });
            return view('posts.create', compact('categories'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(PostCreationRequest $request)
        {
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
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Post $post)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Post $post)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Post $post)
        {
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
        public function myPosts() {
            $creatorId = auth('creator')->id();
            $cacheKey = 'creator_posts_' . $creatorId;

            $creatorPosts = Post::where('creator_id', $creatorId)
                        ->orderBy('created_at', 'desc')
                        ->get();

            return view('posts.myPosts', compact('creatorPosts'));
        }
    }

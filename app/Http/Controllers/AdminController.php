<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\CategoryRequest;
    use App\Http\Requests\EditCreatorByAdminRequest;
    use App\Http\Requests\PostCreationRequest;
    use App\Http\Requests\PostQueryByAdmin;
    use App\Http\Requests\PostSearchRequest;
    use App\Http\Requests\RegistrationRequest;
    use App\Http\Requests\UpdateadminEmail;
    use App\Http\Requests\UpdateAdminProfile;
    use App\Mail\EmailConfirmation;
    use App\Models\Admin;
    use App\Models\Category;
    use App\Models\Creator;
    use App\Models\Post;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Str;

    class AdminController extends Controller
    {
        use AuthorizesRequests;


        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            //
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         */
        public function show(Admin $admin)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Admin $admin)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Admin $admin)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Admin $admin)
        {
            //
        }

        /**
         * admin dashboard
         */
        public function dashboard() 
        {
            // getting creatorsGrwoth per week 
            $totalCreators = Creator::where('role', '=', 'creator')
                ->count();
            $previousCreators = Creator::whereBetween('created_at', [
                now()->subMonth()->startOfMonth(),
                now()->subMonth()->endOfMonth(),
            ])->count();

            $creatorsGrowth = $previousCreators > 0
                ? (($totalCreators - $previousCreators ) / $previousCreators) * 100
                : 100;

            // getting posts growth per month
            $totalPosts = Post::count();
            $previousPosts = Post::whereBetween('created_at', [
                now()->subMonth()->startOfMonth(),
                now()->subMonth()->endOfMonth(),
            ])->count();

            $postsGrowth = $previousPosts > 0
                ? (($totalPosts - $previousPosts) / $previousPosts) * 100
                : 100;

            // pending & accepted Posts
            $pendingPosts = Post::where('status', 'pending')->count();
            $acceptedPosts = Post::where('status', 'accepted')->count();

            // recent activities 
            $newPost = Post::where('status', 'pending')
                ->orWhere('status', 'accepted')
                ->latest()->first();
            $newCreator = Creator::latest()->first();
            $lastUpdatedPost = Post::latest()->first();
            // return with with data
            return view('admin.dashboard', [
                'totalCreators' => $totalCreators,
                'creatorsGrowth' => round($creatorsGrowth, 1),
                'totalPosts' => $totalPosts,
                'postsGrowth' => round($postsGrowth, 1),
                'pendingPosts' => $pendingPosts,
                'acceptedPosts' => $acceptedPosts,
                'newPost' => $newPost,
                'newCreator' => $newCreator,
                'lastUpdatedPost' => $lastUpdatedPost,
            ]);
        }

        /**
         * new Creator
         */
        public function newCreator() {
            return view('admin.new_creator');
        }

        /**
         * new Creator store
         */
        public function newCreatorStore(RegistrationRequest $request) {
            $validatedFields = $request->validated();
            $validatedFields['password'] = Hash::make($validatedFields['password']);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = date('Ymd') . "_" . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('uploads/creators_images', $imageName, 'public');
                $validatedFields['image'] = $imagePath;
            } else {
                $validatedFields['image'] = 'uploads/creators_images/profile.png';
            }

            // Create creator
            $creator = Creator::create([
                'creator_name' => $validatedFields['creator_name'],
                'gender' => $validatedFields['gender'],
                'age' => $validatedFields['age'],
                'email' => $validatedFields['email'],
                'email_verified_at' => now(),
                'password' => $validatedFields['password'],
                'image' => $validatedFields['image'],
                'bio' => $validatedFields['bio'],
            ]);

            // redirect to login page
            return redirect()
                ->route('admin.creators_list')
                ->with('success', 'Creator Created Successfully!');
        }

        /**
         * creators list
         */
        public function creatorsList() {
            $creators = Creator::where([
                ['role', '=', 'creator'],
                ['status', '=', 'active'],
            ])
                ->paginate(6);
            return view('admin.creatorsList', [
                'creators' => $creators,
            ]);
        }

        /**
         * delete creator
         */
        public function deleteCreator(string $id) {
            $creator = Creator::findOrFail($id);
            $creator->delete();
            return redirect()
                ->route('admin.creators_list')
                ->with('success', 'Creator Deleted Successfully!');
        }

        /**
         * edit creator
         */
        public function editCreator(string $creator) {
            $creator = Creator::findOrFail($creator);
            return view('admin.edit_creator', compact('creator'));
        }

        /**
         * update creator
         */
        public function updateCreator(EditCreatorByAdminRequest $request, string $creator) {
            $validatedData = $request->validated();

            // if new image uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = date('Yd') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('uploads/creators_images/', $imageName, 'public');
                $validatedData['image'] = $imagePath;
            }

            Creator::where('id', $creator)
                ->update($validatedData);

            return redirect()->route('creators.show', $creator)
                ->with('success', 'Creator Updated Successfully !');
        }

        /**
         * new Category
         */
        public function newCategory() {
            return view('admin.new_category');
        }

        /**
         * new Category store
         */
        public function newCategoryStore(CategoryRequest $request) {
            $validatedData = $request->validated();

            // case new image uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . '_' . date('Y') . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('uploads/categories_images', $imageName, 'public');
                $validatedData['image'] = $imagePath;
            }

            $slug = Str::slug($validatedData['name']);
            Category::create([
                'name' => $validatedData['name'],
                'slug' => $slug,
                'image' => $validatedData['image'],
            ]);

            return redirect()->route('admin.categories_list')
                ->with('success', 'New Category Created !');
        }

        /**
         * categories List
         */
        public function categoriesList() {
            $categories = Category::with('posts')->paginate(5);
            return view('admin.categories_list', [
                'categories' => $categories,
            ]);
        }

        /**
         * delete category
         */
        public function deleteCategory(string $id) {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.categories_list')
                ->with("success", 'Category Deleted Successfully !');
        }

        /**
         * edit category
         */
        public function editCategory(string $category) {
            $category = Category::findOrFail($category);
            return view('admin.edit_category', compact('category'));
        }

        /**
         * update category
         */
        public function updatecategory(CategoryRequest $request, string $category) {
            $validatedData = $request->validated();

            // case new image uploaded 
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . '_' . date('md') . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('uploads/updated_categories', $imageName, 'public');
                $validatedData['image'] = $imagePath;
            }

            Category::where('id', $category)
                ->update($validatedData);

            return redirect()->route('admin.categories_list')
                ->with('success', 'Category Updated Successfully !');
        }

        /**
         * posts list
         */
        public function postsList(Request $request) {
            $status = $request->query('status');
            $query = Post::with(['creator', 'category'])
                ->latest();

            if($status && in_array($status, ['accepted', 'pending', 'rejected'])) {
                $query->where('status', $status);
            }

            $posts = $query->get();
            return view('admin.posts_list', [
                'posts' => $posts,
                'currentFilter' => $status,
            ]);
        }

        /**
         * delete Post
         */
        public function deletePost(string $post) {
            $post = Post::findOrFail($post);
            $post->delete();

            return to_route('admin.posts_list')
                ->with('success', 'Post Deleted Successfully !');
        }

        /**
         * Edit Post
         */
        public function editPost(string $post) {
            $post = Post::findOrFail($post);
            $categories = Category::all();
            return view('admin.edit_post', compact('post', 'categories'));
        }

        /**
         * update Post
         */
        public function updatePost(PostCreationRequest $request, string $post) {
            $post = Post::findOrFail($post);
            $validatedData = $request->validated();

            // case new image uploaded 
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . "_" . date('dm') . '.' . $image->getClientOriginalExtension();
                $validatedData['image'] = $image->storeAs('uploads/updated_posts', $imageName, 'public');
            }

            $post->update([
                'title' => $validatedData['post_title'],
                'slug' => Str::slug($validatedData['post_title'], '-'),
                'description' => $validatedData['description'],
                'category_id' => $validatedData['category'],
                'image' => $validatedData['image'] ?? $post->image,
                'status' => 'accepted',
            ]);

            return to_route('admin.posts_list')
                ->with('success', 'Post Updated Successfully !');
        }

        /**
         * create Post
         */
        public function newPost() {
            $categories = Category::all();
            return view('admin.create_post', compact('categories'));
        }

        /**
         * store post
         */
        public function newPostStore(PostCreationRequest $request) {
            $validatedData = $request->validated();

            // case image uplaoded 
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . "_" . date('dm') . '.' . $image->getClientOriginalExtension();
                $validatedData['image'] = $image->storeAs('uploads/posts_images', $imageName, 'public');
            } else {
                $validatedData['image'] = 'uploads/posts/images/posts-default-image.png';
            }

            Post::create([
                'title' => $validatedData['post_title'],
                'slug' => Str::slug($validatedData['post_title'], '-'),
                'description' => $validatedData['description'],
                'category_id' => $validatedData['category'],
                'image' => $validatedData['image'],
                'creator_id' => auth('creator')->id(),
                'status' => "accepted",
            ]);

            return to_route('admin.posts_list')
                ->with('success', 'Post Created Successfully !');
        }

        /**
         * find post
         */
        public function findPost() {
            return view('admin.find_post');
        }

        /**
         * Query post
         */
        public function queryPost(PostQueryByAdmin $request) {
            $validatedData = $request->validated();

            $post = Post::where('title', 'like', '%' . $validatedData['query'] . '%')
                ->orWhere('description', 'like', '%' . $validatedData['query'] . '%')
                ->first();

            return view('admin.find_post', compact('post'));
        }

        /**
         * admin profile
         */
        public function profile() {
            $admin = Creator::findOrFail(auth('creator')->id());
            return view('admin.profile', compact('admin'));
        }

        /**
         * edit profile
         */
        public function editProfile(string $id) {
            $admin = Creator::findOrFail($id);
            return view('admin.edit_profile', compact('admin'));
        }

        /**
         * update profile
         */
        public function updateProfile(UpdateAdminProfile $request ,string $id) {
            $validatedData = $request->validated();

            // case new image uploaded 
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . "_" . date('dm') . '.' . $image->getClientOriginalExtension();
                $validatedData['image'] = $image->storeAs('uploads/admins_images', $imageName, 'public');
            } else {
                $validatedData['image'] = Creator::findOrFail($id)->image;
            }

            Creator::where('id', $id)
                ->update($validatedData);

            return to_route('admin.profile')
                ->with('success', 'Profile Updated Successfully !');
        }

        /**
         * edit Email
         */
        public function editEmail(string $id) {
            $admin = Creator::findOrFail($id);
            return view('admin.edit_email', compact('admin'));
        }

        /**
         * update Email
         */
        public function updateEmail(UpdateadminEmail $request, string $id) {
            $admin = Creator::findOrFail($id);
            $validatedData = $request->validated();

            $admin->update(['email' => $validatedData['email']]);
            return to_route('admin.profile')
                ->with('success', 'Email Updated Successfully !');
        }

        /**
         * accept post
         */
        public function acceptPost(Post $post) {
            $post->update(['status' => 'accepted']);

            return to_route('admin.posts_list')
                ->with('success', 'Post Accepted Successfully !');
        }

        /**
         * reject post
         */
        public function rejectPost(Post $post) {
            $post->update(['status' => 'rejected']);

            return to_route('admin.posts_list')
                ->with('success', 'Post rejected Successfully !');
        }

        /**
         * ban creator
         */
        public function banCreator(Creator $creator) {
            $creator = Creator::findOrFail($creator->id);
            $creator->update(['status' => "banned"]);

            return redirect()
                ->route('admin.creators_list')
                ->with('warning', 'Creator Banned Successfully !');
        }

        /**
         * unban creator
         */
        public function unbanCreator(Creator $creator) {
            $creator = Creator::findOrFail($creator->id);
            $creator->update(['status' => "active"]);

            return redirect()
                ->route('admin.creators_list')
                ->with('success', 'Creator Actived Successfully !');
        }

        /**
         * banned creators
         */
        public function bannedCreators() {
            $bannedCreators = Creator::where('status', '=', 'banned')
                ->paginate(6);
            return view('admin.banned_creators', compact('bannedCreators'));
        }
    }

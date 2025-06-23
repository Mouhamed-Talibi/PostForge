<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\CategoryRequest;
    use App\Http\Requests\EditCreatorByAdminRequest;
    use App\Http\Requests\RegistrationRequest;
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
            $totalCreators = Creator::count();
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
            $newPost = Post::where('status', 'pending')->latest()->first();
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
            $creators = Creator::paginate(6);
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
            $categories = Category::paginate(5);
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
    }

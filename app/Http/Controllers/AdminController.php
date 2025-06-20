<?php

    namespace App\Http\Controllers;

    use App\Models\Admin;
    use App\Models\Creator;
    use App\Models\Post;
    use Illuminate\Http\Request;

    class AdminController extends Controller
    {
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

            // return with with data
            return view('admin.dashboard', [
                'totalCreators' => $totalCreators,
                'creatorsGrowth' => round($creatorsGrowth, 1),
                'totalPosts' => $totalPosts,
                'postsGrowth' => round($postsGrowth, 1),
                'pendingPosts' => $pendingPosts,
                'acceptedPosts' => $acceptedPosts,
            ]);
        }
    }

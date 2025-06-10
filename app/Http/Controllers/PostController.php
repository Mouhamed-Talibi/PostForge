<?php

    namespace App\Http\Controllers;

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
        public function store(Request $request)
        {
            //
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
            //
        }
    }

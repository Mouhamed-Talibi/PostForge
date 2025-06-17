<?php

    namespace App\Http\Controllers;

    use App\Models\Post;
    use Illuminate\Http\Request;

    class AppController extends Controller
    {
        // index method 
        public function index() {
            $acceptedPosts = Post::with(['category', 'creator', 'likers'])
                ->withCount('likers')
                ->where('status', 'accepted')
                ->latest()
                ->paginate(10);
            return view('home', compact('acceptedPosts'));
        }
    }

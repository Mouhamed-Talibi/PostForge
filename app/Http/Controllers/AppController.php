<?php

    namespace App\Http\Controllers;

    use App\Models\Post;
    use Illuminate\Http\Request;

    class AppController extends Controller
    {
        // index method 
        public function index() {
            $acceptedPosts = Post::where('status', '=', 'accepted')
                ->paginate(10);
            return view('home', compact('acceptedPosts'));
        }

        // home method 
        public function home() {
            return view('home');
        }
    }

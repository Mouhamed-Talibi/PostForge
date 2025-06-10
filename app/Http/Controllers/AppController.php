<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class AppController extends Controller
    {
        // index method 
        public function index() {
            return view('home');
        }

        // home method 
        public function home() {
            return view('home');
        }
    }

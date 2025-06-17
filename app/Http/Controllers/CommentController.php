<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\CommentRequest;
    use App\Models\Comment;
    use App\Models\Post;
    use Illuminate\Http\Request;

    class CommentController extends Controller
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
        public function store(CommentRequest $request, Post $post)
        {
            $validatedContent = $request->validated();
            // create comment 
            $post->comments()->create([
                'creator_id' => auth('creator')->id(),
                'content' => $validatedContent['content'],
            ]);
            // redirect back with succedd
            return redirect()
                ->back()
                ->with('success', 'Your comment has been added successfully. Thank you for your contribution!');
        }

        /**
         * Display the specified resource.
         */
        public function show(Comment $comment)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Comment $comment)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Comment $comment)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Comment $comment)
        {
            //
        }
    }

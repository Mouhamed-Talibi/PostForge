<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\Post;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all creators 
        $creators = Creator::where('role', '=', 'creator')
            ->orderBy('id', 'DESC')
            ->paginate(9); 
        return view('creators.index', compact('creators'));
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
    public function show(int $id)
    {
        $creator = Creator::findOrFail($id);
        // get creator posts
        $creatorPosts = Post::where('creator_id',$id)
            ->where('status', '=', 'accepted')
            ->get();
        // creator page
        return view('creators.show', compact(['creator', 'creatorPosts']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

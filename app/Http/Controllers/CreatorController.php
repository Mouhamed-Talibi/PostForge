<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCreatorAgeRequest;
use App\Http\Requests\UpdateCreatorBioRequest;
use App\Http\Requests\UpdateCreatorEmailRequest;
use App\Http\Requests\UpdateCreatorNameRequest;
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
            ->where('id', '!=', auth('creator')->id())
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
        $creator = Creator::findOrFail($id);
        $totalPosts = Post::where('creator_id', $id)->count();
        return view('creators.edit', compact(['creator', 'totalPosts']));
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

    /**
     * Update creator email.
     */
    public function updateEmail(UpdateCreatorEmailRequest $request, Creator $creator) {
        $validated = $request->validated();
        $creator->update(['email' => $validated['email']]);

        return redirect()->back()
            ->with('success', 'Email updated successfully!');
    }

    /**
     * Update creator bio.
     */
    public function updateBio(UpdateCreatorBioRequest $request, Creator $creator) {
        $validated = $request->validated();
        $creator->update(['bio' => $validated['bio']]);

        return redirect()->back()
            ->with('success', 'Your Bio updated successfully!');
    }

    /**
     * Update creator name.
     */
    public function updateName(UpdateCreatorNameRequest $request, Creator $creator) {
        $validated = $request->validated();
        $creator->update(['creator_name' => $validated['creator_name']]);

        return redirect()->back()
            ->with('success', 'Your Name updated successfully!');
    }

    /**
     * Update creator age.
     */
    public function updateAge(UpdateCreatorAgeRequest $request, Creator $creator) {
        $validated = $request->validated();
        $creator->update(['age' => $validated['age']]);

        return redirect()->back()
            ->with('success', 'Your Age updated successfully!');
    }
}

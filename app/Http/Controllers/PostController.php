<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return inertia('admin/Index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('admin/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        Post::create($request->validated());

        return to_route('admin.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $post = Post::findOrFail($id);

        return inertia('admin/Show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        return inertia('admin/update', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);

        $post->update($request->validated());

        return to_route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $post = Post::findOrFail($id);
        $post->delete();
        return to_route('admin.index');
    }
}

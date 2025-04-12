<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', ['posts'=>$posts]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string'
        ]);
//        dd($validated);
        Post::create($validated);
        return redirect()->route('posts.index');
    }

    public function show($post)
    {
        $getPostById = Post::find($post);
//        dd($getPostById);

        return view('post.show', ['post' => $getPostById]);
    }

    // Just for redirection from show page.
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    //Sends request to server to update post
    public function update(Request $request, Post $post)
    {   $validated = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post);
    }

    public function destroy()
    {

    }
}

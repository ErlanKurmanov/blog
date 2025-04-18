<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => 'required|exists:categories,id',
            'tags' => '',
        ]);
        //it's an array of tag's id:
        $tags = $validated['tags'];
        $post = Post::create($validated);
        $post->tags()->attach($tags);

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
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags]
        );
    }

    //Sends request to server to update post
    public function update(Request $request, int $post)
    {
        $post = Post::findOrFail($post);
        $validated = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id', // each tag must be a valid tag ID
        ]);

//        dd($validated);
        $tags = $validated['tags'];
//        unset($tags);
        $post->update($validated);

        $post->tags()->sync($tags);

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}

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
        return view('post.index', ['posts'=>$posts]);
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

        $tags = $validated['tags'];
//        dd($tags);
//        unset($tags);

        $post = Post::create($validated);
        foreach($tags as $tag){
            PostTag::firstOrCreate([
                'tag_id' => $tag,
                'post_id' => $post->id
            ]);
        }

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
        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }

    //Sends request to server to update post
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => ''
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $service)
    {
        $this->postService = $service;
    }

    public function index()
    {
        $posts = Post::query()->paginate(30);
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

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->postService->store($data);

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
    public function update(UpdateRequest $request, Post $post)
    {
//        $post = Post::findOrFail($post);
        $inputData = $request->validated();

        $this->postService->update($post, $inputData);

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}

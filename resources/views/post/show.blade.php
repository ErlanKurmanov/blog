@extends('layouts.app')

@section('title')
    Show post
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card">
            <!-- Post Image -->
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
            @endif

            <div class="card-body">
                <!-- Post Title -->
                <h2 class="card-title">{{ $post->title }}</h2>

                <!-- Post Content -->
                <p class="card-text">{{ $post->content }}</p>

                <!-- Back Button -->
                <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
                <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-secondary mt-3">Edit post</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary">Delete</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    All Posts
@endsection

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>All Posts</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($posts->count())
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
{{--                            @if ($post->image)--}}
{{--                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">--}}
{{--                            @endif--}}
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary mt-auto">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $posts->onEachSide(1)->links() }}
            </div>
        @else
            <p>No posts found.</p>
        @endif
    </div>
@endsection

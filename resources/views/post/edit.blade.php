
@extends('layouts.app')

@section('title')
    Edit post
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Edit Post</h2>

        <!-- Update Form -->
        <form action="{{ route('posts.update', $post->id) }}" method="POST" {{--enctype="multipart/form-data"--}}>
            @csrf
            @method('patch')

            <!-- Title Input -->
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>

            <!-- Content Input -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Update Image</label>
                <input class="form-control" type="text" id="image" name="image" {{--accept="image/*"--}}>
{{--                @if ($post->image)--}}
{{--                    <p class="mt-2">Current Image:</p>--}}
{{--                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="img-thumbnail" width="200">--}}
{{--                @endif--}}
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Update Post</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    Create post
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Create a New Post</h2>
        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            @method('POST')
            <!-- Title Input -->
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <!-- Content Input -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input class="form-control" type="text" id="image" name="image" {{-- accept="image/*" --}} />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Post</button>
        </form>
    </div>


@endsection

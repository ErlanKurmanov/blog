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
                <input value="{{old('title')}}" type="text" class="form-control" id="title" name="title" {{--<!--required-->--}}>
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <!-- Content Input -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                @error('content')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input class="form-control" type="text" id="image" name="image" {{-- accept="image/*" --}} />
            </div>
            <div class="mb-3">
                <label for="category_id">Category</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option value="" selected>Choose category</option>
                    @foreach($categories as $category)
                        <option {{old('category_id') == $category->id ? 'selected' : ''}}
                            value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select multiple class="form-control" id="tags"  name="tags[]">
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
            </div>



            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Post</button>
        </form>
    </div>

@endsection

<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function store($data)
    {
        $tags = $data['tags'] ?? [];
        $post = Post::create($data);
        $post->tags()->attach($tags);

    }

    public function update($post, $inputData)
    {
        $tags = $inputData['tags'] ?? [];
        unset($inputData['tags']);

        $post->update($inputData); // Update post without tags field
        $post->tags()->sync($tags); // Update the tag relationships separately
    }
}

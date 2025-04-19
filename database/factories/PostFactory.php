<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()?->id, // safe access operator
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'image' => fake()->optional()->imageUrl(), // image can be null
            'likes' => fake()->optional()->numberBetween(0, 1000), // likes can be null
        ];
    }
}

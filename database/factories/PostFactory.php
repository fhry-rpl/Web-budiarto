<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => fake()->sentence(),
            'slug' => fake()->unique()->slug(3),
            'category_id' => Category::where('type', 'post')->inRandomOrder()->first()?->id,
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraphs(3, true),
            'is_published' => true,
            'published_at' => fake()->dateTimeThisYear(),
        ];
    }
}

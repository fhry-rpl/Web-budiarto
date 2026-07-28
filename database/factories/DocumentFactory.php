<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => fake()->sentence(),
            'slug' => fake()->unique()->slug(3),
            'category_id' => Category::where('type', 'dokumen')->inRandomOrder()->first()?->id,
            'description' => fake()->paragraph(),
            'file_path' => 'documents/sample.pdf',
            'download_count' => fake()->numberBetween(0, 500),
            'is_published' => true,
            'published_at' => fake()->dateTimeThisYear(),
        ];
    }
}

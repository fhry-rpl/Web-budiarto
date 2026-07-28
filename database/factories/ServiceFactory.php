<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraphs(2, true),
            'procedure' => fake()->paragraphs(2, true),
            'requirements' => fake()->paragraphs(2, true),
            'contact_info' => fake()->phoneNumber(),
            'order' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => [
                'en' => $this->faker->sentence(3),
                'ru' => $this->faker->sentence(3),
                'uz' => $this->faker->sentence(3),
            ],
            'description' => [
                'en' => $this->faker->paragraph(4),
                'ru' => $this->faker->paragraph(4),
                'uz' => $this->faker->paragraph(4),
            ],
            'photo' => [
                'en' => $this->faker->imageUrl(400, 600, 'books'),
                'ru' => $this->faker->imageUrl(400, 600, 'books'),
                'uz' => $this->faker->imageUrl(400, 600, 'books'),
            ],
            'pdf' => $this->faker->url(),
            'selling_method' => $this->faker->randomElement(['digital', 'physical', 'both']),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'category_id' => \App\Models\Category::factory(),
            'brand_id' => \App\Models\Brand::factory(),
            'user_id' => \App\Models\User::factory(),
            'author_id' => \App\Models\Author::factory(),
        ];
    }
}

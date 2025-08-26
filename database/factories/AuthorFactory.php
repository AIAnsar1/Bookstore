<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'en' => $this->faker->name(),
                'ru' => $this->faker->name(),
                'uz' => $this->faker->name(),
            ],
            'photo' => [
                'en' => $this->faker->imageUrl(300, 400, 'people'),
                'ru' => $this->faker->imageUrl(300, 400, 'people'),
                'uz' => $this->faker->imageUrl(300, 400, 'people'),
            ],
            'description' => [
                'en' => $this->faker->paragraph(3),
                'ru' => $this->faker->paragraph(3),
                'uz' => $this->faker->paragraph(3),
            ],
        ];
    }
}

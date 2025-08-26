<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
                'en' => $this->faker->words(2, true),
                'ru' => $this->faker->words(2, true),
                'uz' => $this->faker->words(2, true),
            ],
            'photo' => $this->faker->imageUrl(200, 200, 'business'),
            'parent_id' => null, // Will be set in specific factory states
        ];
    }

    /**
     * Create a subcategory with parent
     */
    public function withParent($parentId = null): static
    {
        return $this->state(function (array $attributes) use ($parentId) {
            return [
                'parent_id' => $parentId ?? \App\Models\Category::factory()->create()->id,
            ];
        });
    }
}

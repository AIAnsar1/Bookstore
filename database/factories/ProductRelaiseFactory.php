<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductRelaise>
 */
class ProductRelaiseFactory extends Factory
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
            ],
            'description' => [
                'en' => $this->faker->paragraph(),
                'ru' => $this->faker->paragraph(),
            ],
            'pdf' => $this->faker->url() . '.pdf',
            'status_price' => $this->faker->randomFloat(2, 5, 100),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}

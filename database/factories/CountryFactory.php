<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_info' => [
                'en' => $this->faker->country(),
                'ru' => $this->faker->country(),
                'uz' => $this->faker->country(),
            ],
            'parent_id' => null, // Default to null for root countries
        ];
    }

    /**
     * Create a region with parent country
     */
    public function region($countryId = null): static
    {
        return $this->state(function (array $attributes) use ($countryId) {
            return [
                'parent_id' => $countryId ?? \App\Models\Country::factory()->create()->id,
                'country_info' => [
                    'en' => $this->faker->state(),
                    'ru' => $this->faker->state(),
                    'uz' => $this->faker->state(),
                ],
            ];
        });
    }
}

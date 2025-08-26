<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['admin', 'user', 'moderator', 'editor']),
            'guard_name' => 'web',
        ];
    }

    /**
     * Create admin role
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin',
        ]);
    }

    /**
     * Create user role
     */
    public function user(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'user',
        ]);
    }
}

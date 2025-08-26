<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'photo' => $this->faker->imageUrl(200, 200, 'people'),
            'country_id' => \App\Models\Country::factory(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password for testing
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create user with specific role
     */
    public function withRole(string $role = 'admin'): static
    {
        return $this->afterCreating(function (\App\Models\User $user) use ($role) {
            $roleModel = \App\Models\Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web'
            ]);
            $user->roles()->attach($roleModel->id);
        });
    }
}

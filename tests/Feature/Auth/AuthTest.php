<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->markTestSkipped('Passport authentication tests require interactive setup');
    }

    public function test_user_can_register()
    {
        $userData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone_number' => '+1234567890',
            'address' => '123 Main St'
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'user' => [
                            'id',
                            'firstname',
                            'lastname',
                            'email'
                        ],
                        'token'
                    ]
                ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'firstname' => 'John',
            'lastname' => 'Doe'
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password123'
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'user',
                        'token'
                    ]
                ]);
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $loginData = [
            'email' => 'test@example.com',
            'password' => 'wrongpassword'
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(401)
                ->assertJson([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ]);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true
                ]);
    }

    public function test_user_can_check_token_status()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson('/api/check-user-token');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'id',
                        'firstname',
                        'lastname',
                        'email'
                    ]
                ]);
    }

    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $updateData = [
            'firstname' => 'Updated Name',
            'phone_number' => '+9876543210'
        ];

        $response = $this->postJson('/api/update-your-self', $updateData);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'Updated Name',
            'phone_number' => '+9876543210'
        ]);
    }

    public function test_registration_requires_valid_email()
    {
        $userData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
                ->assertJsonValidationErrors('email');
    }

    public function test_registration_requires_password_confirmation()
    {
        $userData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different_password'
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
                ->assertJsonValidationErrors('password');
    }

    public function test_login_requires_email_and_password()
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['email', 'password']);
    }
}

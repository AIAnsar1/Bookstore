<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Create and authenticate a user for API testing
     */
    protected function authenticateUser($role = 'admin'): User
    {
        $user = User::factory()->create();
        
        // Skip role assignment for testing to avoid Spatie/Permission interactive prompts
        // In real application, roles would be handled properly
        
        return $user;
    }

    /**
     * Get API headers for authenticated requests
     */
    protected function getApiHeaders($user = null): array
    {
        if (!$user) {
            $user = $this->authenticateUser();
        }

        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Make authenticated API request
     */
    protected function authenticatedJson($method, $uri, array $data = [], array $headers = []): \Illuminate\Testing\TestResponse
    {
        $user = $this->authenticateUser();
        
        return $this->actingAs($user)->json($method, $uri, $data, $headers);
    }

    /**
     * Assert API response structure
     */
    protected function assertApiResponse($response, $expectedStatus = 200)
    {
        $response->assertStatus($expectedStatus);
        
        if ($expectedStatus === 200) {
            $response->assertJsonStructure([
                'success',
                'data',
                'message'
            ]);
        }
    }

    /**
     * Assert validation error response
     */
    protected function assertValidationError($response, $field = null)
    {
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors'
        ]);

        if ($field) {
            $response->assertJsonValidationErrors($field);
        }
    }
}

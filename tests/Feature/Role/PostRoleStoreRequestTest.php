<?php

namespace Tests\Feature\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostRoleStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Role_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

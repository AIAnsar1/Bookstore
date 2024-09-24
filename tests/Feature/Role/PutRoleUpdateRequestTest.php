<?php

namespace Tests\Feature\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutRoleUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Role_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

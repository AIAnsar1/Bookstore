<?php

namespace Tests\Feature\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRoleShowRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Role_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

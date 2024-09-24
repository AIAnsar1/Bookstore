<?php

namespace Tests\Feature\Status;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteStatusDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Status_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

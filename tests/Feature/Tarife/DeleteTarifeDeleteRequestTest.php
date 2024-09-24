<?php

namespace Tests\Feature\Tarife;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTarifeDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Tarife_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

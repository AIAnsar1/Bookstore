<?php

namespace Tests\Feature\Tarife;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTarifeIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Tarife_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

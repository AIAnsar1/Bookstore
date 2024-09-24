<?php

namespace Tests\Feature\Tarife;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutTarifeUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Tarife_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

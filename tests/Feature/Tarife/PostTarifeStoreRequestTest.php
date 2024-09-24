<?php

namespace Tests\Feature\Tarife;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTarifeStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Tarife_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

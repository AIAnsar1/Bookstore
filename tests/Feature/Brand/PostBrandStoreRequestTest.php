<?php

namespace Tests\Feature\Brand;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostBrandStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Brand_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostProductStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Product_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

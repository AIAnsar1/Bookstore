<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutProductUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Product_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProductIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Product_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

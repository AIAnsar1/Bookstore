<?php

namespace Tests\Feature\ProductRelaise;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostProductRelaiseStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_ProductRelaise_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

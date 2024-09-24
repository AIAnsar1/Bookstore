<?php

namespace Tests\Feature\ProductRelaise;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductRelaiseDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_ProductRelaise_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

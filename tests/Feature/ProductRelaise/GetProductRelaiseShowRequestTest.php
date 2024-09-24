<?php

namespace Tests\Feature\ProductRelaise;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProductRelaiseShowRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_ProductRelaise_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

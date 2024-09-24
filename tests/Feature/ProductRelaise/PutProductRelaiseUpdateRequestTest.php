<?php

namespace Tests\Feature\ProductRelaise;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutProductRelaiseUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_ProductRelaise_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

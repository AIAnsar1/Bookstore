<?php

namespace Tests\Feature\Brand;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutBrandUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Brand_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

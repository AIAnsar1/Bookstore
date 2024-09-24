<?php

namespace Tests\Feature\Brand;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetBrandShowRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Brand_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

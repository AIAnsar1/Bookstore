<?php

namespace Tests\Feature\Brand;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteBrandDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Brand_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

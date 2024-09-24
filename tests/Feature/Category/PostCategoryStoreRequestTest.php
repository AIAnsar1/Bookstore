<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCategoryStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Category_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

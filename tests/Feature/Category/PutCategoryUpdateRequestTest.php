<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutCategoryUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Category_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

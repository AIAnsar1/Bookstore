<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCategoryIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Category_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

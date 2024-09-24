<?php

namespace Tests\Feature\Faq;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostFaqStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Faq_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

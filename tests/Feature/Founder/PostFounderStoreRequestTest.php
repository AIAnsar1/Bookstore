<?php

namespace Tests\Feature\Founder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostFounderStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Founder_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Status;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostStatusStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Status_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostAuthorStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Author_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

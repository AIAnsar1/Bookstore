<?php

namespace Tests\Feature\Genre;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostGenreStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Genre_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

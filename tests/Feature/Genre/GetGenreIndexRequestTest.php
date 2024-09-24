<?php

namespace Tests\Feature\Genre;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetGenreIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Genre_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

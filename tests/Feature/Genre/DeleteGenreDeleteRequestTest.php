<?php

namespace Tests\Feature\Genre;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteGenreDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Genre_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

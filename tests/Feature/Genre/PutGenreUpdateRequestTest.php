<?php

namespace Tests\Feature\Genre;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutGenreUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Genre_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

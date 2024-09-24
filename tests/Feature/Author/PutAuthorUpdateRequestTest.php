<?php

namespace Tests\Feature\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutAuthorUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Author_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

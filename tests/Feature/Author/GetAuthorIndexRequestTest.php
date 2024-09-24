<?php

namespace Tests\Feature\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAuthorIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Author_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

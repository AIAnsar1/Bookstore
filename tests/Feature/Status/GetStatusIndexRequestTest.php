<?php

namespace Tests\Feature\Status;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetStatusIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Status_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

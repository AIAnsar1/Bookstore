<?php

namespace Tests\Feature\Status;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutStatusUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Status_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

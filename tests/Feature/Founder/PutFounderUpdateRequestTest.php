<?php

namespace Tests\Feature\Founder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutFounderUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Founder_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

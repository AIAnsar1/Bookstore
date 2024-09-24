<?php

namespace Tests\Feature\Founder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetFounderIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Founder_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

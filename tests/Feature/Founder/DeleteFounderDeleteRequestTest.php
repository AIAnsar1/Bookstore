<?php

namespace Tests\Feature\Founder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteFounderDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Founder_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

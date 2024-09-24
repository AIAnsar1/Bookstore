<?php

namespace Tests\Feature\Faq;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutFaqUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Faq_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

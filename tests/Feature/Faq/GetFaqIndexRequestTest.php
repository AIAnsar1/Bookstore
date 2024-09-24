<?php

namespace Tests\Feature\Faq;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetFaqIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Faq_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

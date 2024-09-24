<?php

namespace Tests\Feature\Faq;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteFaqDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Faq_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutPaymentUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Payment_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

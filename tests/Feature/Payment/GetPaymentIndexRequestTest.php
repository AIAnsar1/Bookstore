<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetPaymentIndexRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Payment_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostPaymentStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Payment_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}
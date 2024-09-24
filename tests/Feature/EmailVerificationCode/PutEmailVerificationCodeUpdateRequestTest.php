<?php

namespace Tests\Feature\EmailVerificationCode;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PutEmailVerificationCodeUpdateRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_EmailVerificationCode_Put_request(): void
    {
        $response = $this->Put('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\EmailVerificationCode;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetEmailVerificationCodeShowRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_EmailVerificationCode_Get_request(): void
    {
        $response = $this->Get('/');

        $response->assertStatus(200);
    }
}

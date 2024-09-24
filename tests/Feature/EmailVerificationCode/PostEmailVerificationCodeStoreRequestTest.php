<?php

namespace Tests\Feature\EmailVerificationCode;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostEmailVerificationCodeStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_EmailVerificationCode_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}

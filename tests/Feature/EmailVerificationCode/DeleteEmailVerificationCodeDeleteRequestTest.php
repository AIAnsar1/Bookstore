<?php

namespace Tests\Feature\EmailVerificationCode;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteEmailVerificationCodeDeleteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_EmailVerificationCode_Delete_request(): void
    {
        $response = $this->Delete('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\TestCase;

class EmailSendTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_email_can_send_to_user_successfully()
    {
        Mail::fake();

        $user = User::all()->first();

        $user->sendEmailVerificationNotification();

    }
}

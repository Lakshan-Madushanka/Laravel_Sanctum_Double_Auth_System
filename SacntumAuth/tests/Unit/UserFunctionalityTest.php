<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserFunctionalityTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_user_get_verification_email_after_added_or_registerd()
    {
        $user = User::all()->random(1);

        $email = $user->sendEmailVerificationNotification();

        dd($email);

    }
}

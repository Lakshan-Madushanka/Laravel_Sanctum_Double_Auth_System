<?php

namespace Tests\Feature;

use App\Http\Requests\UserCreatedRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UserFunctionalityTest extends TestCase
{
    use RefreshDatabase;
    use HasFactory;


    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_request_password_field_validated_successfully()
    {
        $response = $this->Json('post', '/api/v1/users/register', [
            'name'     => 'Sally',
            'email'    => 'email',
            'password' => 'aaaaaa'
        ]);

        $response->assertStatus(422)->assertJson([
            'status' => 'error',
            'errors' => [
                'password' => [
                    "You are using a dumb password (like abcd)",
                    "The password must be at least 8 characters.",
                    "Must contain both upper and lower case, special characters and number",
                    "The password confirmation does not match."
                ]
            ]
        ]);
    }

    public function test_user_request_password_confirmed_field_matched_with_password()
    {
        $response = $this->Json('post', '/api/v1/users/register', [
            'name'                  => 'Sally',
            'email'                 => 'email',
            'password'              => 'aahahhHh#$262',
            'password_confirmation' => 'aahahhHh#$2621'
        ]);

        $response->assertStatus(422)->assertJson([
            'status' => 'error',
            'errors' => [
                'password' => [
                    "The password confirmation does not match."

                ]
            ]
        ]);
    }

    public function test_user_request_email_field_validated_successfully()
    {
        $response = $this->Json('post', '/api/v1/users/register', [
            'name'     => 'Sally',
            'email'    => 'email',
            'password' => 'password'
        ]);

        $response->assertStatus(422)->assertJson([
            'status' => 'error',
            'errors' => [
                'email' => ["The email must be a valid email address."]
            ]
        ]);
    }

    /* public function test_user_request_validated_successfully()
     {
         $user = User::factory()->raw([
                 'name' => ''
             ]
         );

         $rules = [
             'name'     => ['required', 'string', 'max:255'],
             'email'    => [
                 'required', 'string', 'email', 'max:255', 'unique:users'
             ],
             'password' => [
                 'required', 'string',
                 'min:8',
                 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                 'confirmed'
             ]

         ];

         $messages = [
             'name.required' => 'name required'
         ];

         $v = Validator::make($user, $rules, $messages);
         $this->assertEquals($v->errors()->first(), 'name required');
     }

 */
    public function test_user_registered_or_added_successfully()
    {
        $request = UserCreatedRequest::create('/api/v1/users/register', 'post',
            ['name' => 'lak']);

        $response = $this->json('POST', '/api/v1/users/register', [
            'name'                  => 'testing',
            'email'                 => 's2@gmail.com',
            'password'              => 'Password567*1',
            'password_confirmation' => 'Password567*1'
        ]);

        $response->assertStatus(201)->assertJson([
            'status'         => 'ok',
            'status_message' => 'created'
        ]);

    }

    /** @test */
    /* public function test_user_get_verification_email_after_added_or_registerd()
     {
         $user = User::factory()->create();
         $email = $user->sendEmailVerificationNotification();
     }*/

    public function test_user_confirmed_verification_email_after_added_or_registerd()
    {
        $user = (User::factory()->create());
        $this->be($user);
        $email = $user->email;
        $hashedEmail = sha1($email);

        $response = $this->json('get', "/api/v1/email/verify/{$user->id}/{$hashedEmail}");

        $verifiedUser = User::find($user->id);
        $response->assertStatus(401);
        $this->assertNotEmpty($verifiedUser->email_verified_at);
    }

}

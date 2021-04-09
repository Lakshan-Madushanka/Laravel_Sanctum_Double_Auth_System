<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_registered_users_can_obtain_sanctum_api_token()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create(['password' => Hash::make('password')]);
        $a = $user->save();

        $response = $this->json('post', 'api/v1/auth/token',
            [
                'password'    => 'password',
                'email'       => $user->email,
                'device_name' => 'device'
            ]);

        $response->assertOk();
    }

    public function test_auth_users_can_get_all_roles()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            );

        $response = $this->get('/api/v1/roles');

        $response->assertStatus(403);
    }

    public function test_only_admin_users_can_get_role_details()
    {
        $user = Sanctum::actingAs(
            User::factory()->create()//
            );
        $user->roles()->syncWithoutDetaching(1);
        $response = $this->get('/api/v1/roles');
        $response->assertOk();
    }

}

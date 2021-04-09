<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleFunctionalityTest extends TestCase
{
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

    /** @test */
    public function test_get_all_roles_successfully()
    {
        $responce = $this->Json('get', 'api/v1/roles');
        $roleCount = Role::all()->count();

        $responce->assertStatus(200)->assertJson([
            'status' => 'ok'
        ]);
        $this->assertEquals(2, $roleCount);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeds_successfully()
    {
        $this->withExceptionHandling();
        $this->seed();

        $noOfUsers = User::all()->count();
        $noOfRoles = Role::all()->count();

        $this->assertEquals($noOfUsers, 10);
        $this->assertEquals($noOfRoles, 2);

    }

}

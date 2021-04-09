<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->setFKCheckOff();
        User::truncate();
        User::flushEventListeners();
        Role::truncate();
        Role::flushEventListeners();

        //create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'regular']);

        User::factory(10)->create()->each(
            function ($user) {
                $roleId = Role::all()->random()->pluck('id');
                $user->roles()->attach($roleId);
            }
        );

    }

    private function setFKCheckOff()
    {
        switch (DB::getDriverName())
        {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');
                break;
        }
    }
}

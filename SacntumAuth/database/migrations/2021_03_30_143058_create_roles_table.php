<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });

       $this->insertDefaultsRoles();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }

    public function insertDefaultsRoles()
    {
        DB::beginTransaction();
        try {
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'regular']);
            DB::commit();
        } catch (PDOException $exception) {
            DB::rollBack();
        }
    }
}

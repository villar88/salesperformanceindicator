<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->unique();
        });

        DB::table('roles')->insert(array('name' => 'SuperAdmin','description' => "Super Admin"));
        DB::table('roles')->insert(array('name' => 'Member','description' => "Member"));
        DB::table('roles')->insert(array('name' => 'Manager','description' => "Manager"));
        DB::table('roles')->insert(array('name' => 'Owner','description' => "Owner"));

    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('roles');
	}

}

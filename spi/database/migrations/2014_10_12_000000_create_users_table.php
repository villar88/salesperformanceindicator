<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email')->unique();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('password', 60);

            $table->integer('role_id');

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();

            $table->string('contact_number');

            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');

            $table->string('status');

            $table->rememberToken();
            $table->timestamps();

        });

    }
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

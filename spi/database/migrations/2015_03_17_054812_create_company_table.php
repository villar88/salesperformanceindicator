<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {

        Schema::create('companies', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();

            $table->string('status');

            $table->integer('created_by');
            $table->integer('updated_by');

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
        Schema::drop('companies');
	}

}

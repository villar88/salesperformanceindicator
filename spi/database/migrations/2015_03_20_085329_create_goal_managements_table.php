<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goal_managements', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id');


            $table->double('jan');
            $table->double('feb');
            $table->double('mar');
            $table->double('apr');
            $table->double('may');
            $table->double('jun');
            $table->double('jul');
            $table->double('aug');
            $table->double('sep');
            $table->double('oct');
            $table->double('nov');
            $table->double('dec');
            $table->double('annual');

            //$table->double('direct_hire');
            //$table->double('gmp');

            $table->integer('created_by');
            $table->integer('updated_by');

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
		Schema::drop('goal_managements');
	}

}

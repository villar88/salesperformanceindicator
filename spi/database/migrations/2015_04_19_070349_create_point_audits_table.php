<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointAuditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('point_audits', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('point');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->integer('task_id');
            $table->date('date');
            $table->boolean('review')->default(false);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('point_audits');
	}

}

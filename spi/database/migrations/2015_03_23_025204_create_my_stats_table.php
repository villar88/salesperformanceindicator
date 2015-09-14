<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('my_stats', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');
            $table->integer('task_id');
            $table->date('date');
            $table->integer('point');
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
		Schema::drop('my_stats');
	}

}

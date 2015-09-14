<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales', function(Blueprint $table)
		{
            $table->string('id');
            $table->string('month');
            $table->string('year');
            $table->integer('user_id');
            $table->integer('company_id');
			$table->integer('saleType_id');
			$table->double('sale');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sales');
	}

}

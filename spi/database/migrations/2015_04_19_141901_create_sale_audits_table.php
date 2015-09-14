<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleAuditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sale_audits', function(Blueprint $table)
		{
            $table->increments('id');
            $table->double('sale');
            $table->integer('user_id');
            $table->integer('company_id');
			$table->integer('saleType_id');
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
		Schema::drop('sale_audits');
	}

}

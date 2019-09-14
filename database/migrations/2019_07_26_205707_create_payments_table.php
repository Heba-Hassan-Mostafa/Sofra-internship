<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id');
			$table->decimal('paid');
			$table->decimal('remaining');
			//$table->decimal('app_commission');
			$table->string('notes');
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}
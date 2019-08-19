<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealsTable extends Migration {

	public function up()
	{
		Schema::create('meals', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('image');
			$table->string('short_description');
			$table->decimal('price');
			$table->decimal('discount_price');
			$table->string('preparation_time');
			$table->integer('restaurant_id');
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}
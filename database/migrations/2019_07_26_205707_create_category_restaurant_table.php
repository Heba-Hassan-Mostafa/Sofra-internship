<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryRestaurantTable extends Migration {

	public function up()
	{
		Schema::create('category_restaurant', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id');
			$table->integer('category_id');
		});
	}

	public function down()
	{
		Schema::drop('category_restaurant');
	}
}
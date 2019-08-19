<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email', 100)->unique();
			$table->string('phone');
			$table->string('password');
			$table->integer('district_id');
			$table->decimal('min_price');
			$table->decimal('delivery_price');
			$table->string('whatsapp_num');
			$table->string('image');
			$table->enum('status', array('open', 'close'));
			$table->string('api_token')->unique()->nullable();
			$table->string('pin_code')->nullable();
			$table->boolean('activated')->default(1);;
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->string('name','50');
            $table->string('image','100');
			$table->integer('restaurant_id');
			$table->string('content');
			$table->datetime('date_from');
			$table->datetime('date_to');
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}
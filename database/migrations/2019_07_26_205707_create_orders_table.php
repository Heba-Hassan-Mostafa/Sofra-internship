<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id');
			$table->integer('client_id');
			$table->decimal('price')->nullable();
			$table->decimal('total_price')->nullable();
			$table->decimal('delivery_price')->nullable();
			$table->decimal('commission')->nullable();
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered', 'declined'));
			$table->string('notes');
            $table->string('address');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
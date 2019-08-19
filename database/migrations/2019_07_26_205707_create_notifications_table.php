<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('order_id');
			$table->string('title');
			$table->string('content');
			$table->integer('notificationable_id');
			$table->string('notificationable_type');
            $table->string('is_read')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
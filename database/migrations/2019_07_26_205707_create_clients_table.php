<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email', 100)->unique();
			$table->string('phone');
			$table->string('password');
            $table->string('address', 200)->unique();
            $table->integer('district_id');
			$table->string('api_token')->unique()->nullable();
			$table->boolean('activated')->default(1);
			$table->string('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('about_app');
            $table->float('commission');
			$table->string('commission_text1');
			$table->string('commission_text2');
			$table->string('email');
			$table->string('phone');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
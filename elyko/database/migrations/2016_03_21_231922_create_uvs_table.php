<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUvsTable extends Migration {

	public function up()
	{
		Schema::create('uvs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('credits');
			$table->string('semester');
		});
	}

	public function down()
	{
		Schema::drop('uvs');
	}
}
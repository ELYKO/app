<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUvsTable extends Migration {

	public function up()
	{
		Schema::create('uvs', function(Blueprint $table) {
			$table->integer('id')->unsigned();
			$table->string('name');
			$table->float('credits');
			$table->string('semester');
			$table->string('state');
			$table->primary('id');
		});
	}

	public function down()
	{
		Schema::drop('uvs');
	}
}
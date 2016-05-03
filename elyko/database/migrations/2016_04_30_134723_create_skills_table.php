<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillsTable extends Migration {

	public function up()
	{
		Schema::create('skills', function(Blueprint $table) {
			$table->integer('id')->unsigned();
			$table->string('name')->nullable();
			$table->string('semester')->nullable();
			$table->primary('id');
		});
	}

	public function down()
	{
		Schema::drop('skills');
	}
}
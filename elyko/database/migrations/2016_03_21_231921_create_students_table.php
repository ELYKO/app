<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
			$table->integer('id')->unsigned();
			$table->string('last_name');
			$table->string('name');
			$table->string('email')->nullable();
			$table->string('login')->nullable();
			$table->primary('id');
		});
	}

	public function down()
	{
		Schema::drop('students');
	}
}
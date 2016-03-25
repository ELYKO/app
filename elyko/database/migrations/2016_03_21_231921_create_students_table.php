<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
			$table->increments('id');
			$table->string('last_name');
			$table->string('name');
			$table->string('email');
			$table->string('login');
		});
	}

	public function down()
	{
		Schema::drop('students');
	}
}
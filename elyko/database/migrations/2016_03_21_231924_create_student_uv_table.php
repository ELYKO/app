<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentUvTable extends Migration {

	public function up()
	{
		Schema::create('student_uv', function(Blueprint $table) {
			$table->integer('student_id')->unsigned();
			$table->integer('uv_id')->unsigned();
			$table->string('grade');
			$table->primary(['student_id','uv_id']);
		});
	}

	public function down()
	{
		Schema::drop('student_uv');
	}
}
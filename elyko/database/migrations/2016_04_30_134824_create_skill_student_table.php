<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillStudentTable extends Migration {

	public function up()
	{
		Schema::create('skill_student', function(Blueprint $table) {
			$table->integer('skill_id')->unsigned();
			$table->integer('student_id')->unsigned();
			$table->string('value');
			$table->primary(['skill_id','student_id']);
		});
	}

	public function down()
	{
		Schema::drop('skill_student');
	}
}
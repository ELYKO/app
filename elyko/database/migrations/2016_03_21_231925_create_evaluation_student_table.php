<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationStudentTable extends Migration {

	public function up()
	{
		Schema::create('evaluation_student', function(Blueprint $table) {
			$table->integer('evaluation_id')->unsigned();
			$table->integer('student_id')->unsigned();
			$table->string('note')->nullable();
			$table->primary(['evaluation_id','student_id']);
		});
	}

	public function down()
	{
		Schema::drop('evaluation_student');
	}
}
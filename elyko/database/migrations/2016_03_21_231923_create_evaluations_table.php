<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('uv_id')->unsigned();
			$table->string('name');
			$table->decimal('coefficient');
			$table->boolean('locked');
		});
	}

	public function down()
	{
		Schema::drop('evaluations');
	}
}
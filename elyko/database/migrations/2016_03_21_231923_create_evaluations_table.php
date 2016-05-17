<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table) {
			$table->integer('id')->unsigned();
			$table->integer('uv_id')->unsigned();
			$table->string('name');
			$table->float('coefficient');
			$table->boolean('locked');
			$table->primary('id');
		});
	}

	public function down()
	{
		Schema::drop('evaluations');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table) {
			$table->integer('id')->unsigned();
			$table->integer('uv_id')->unsigned();
			$table->string('name')->nullable();
			$table->decimal('coefficient')->nullable();
			$table->boolean('locked')->nullable();
			$table->primary('id');
		});
	}

	public function down()
	{
		Schema::drop('evaluations');
	}
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkConstrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('evaluations', function ($table) {
            $table->foreign('uv_id')->references('id')->on('uvs');
        });

        Schema::table('evaluation_student', function ($table) {
            $table->foreign('evaluation_id')->references('id')->on('evaluations');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::table('student_uv', function ($table) {
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('uv_id')->references('id')->on('uvs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('evaluations', function ($table) {
            $table->dropForeign('evaluations_uv_id_foreign');
        });

        Schema::table('evaluation_student', function ($table) {
            $table->dropForeign('evaluation_student_evaluation_id_foreign');
            $table->dropForeign('evaluation_student_student_id_foreign');
        });

        Schema::table('student_uv', function ($table) {
            $table->dropForeign('student_uv_student_id_foreign');
            $table->dropForeign('student_uv_uv_id_foreign');
        });

    }
}

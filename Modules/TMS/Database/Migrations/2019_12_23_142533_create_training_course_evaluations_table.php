<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCourseEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_course_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->double('score')->nullable();
            $table->date('date');
            $table->string('recommendation');
            $table->string('good_parts');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('training_evaluation_question_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_course_evaluations');
    }
}

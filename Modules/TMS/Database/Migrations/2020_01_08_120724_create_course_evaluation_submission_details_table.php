<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEvaluationSubmissionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_evaluation_submission_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_evaluation_submission_id');
            $table->unsignedInteger('course_evaluation_questionnaire_id');
            $table->unsignedInteger('course_evaluation_option_id')->nullable();
            $table->text('answer')->nullable();
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
        Schema::dropIfExists('course_evaluation_submission_details');
    }
}

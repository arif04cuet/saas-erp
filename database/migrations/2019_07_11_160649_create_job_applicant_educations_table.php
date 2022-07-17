<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicantEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicant_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_application_id');
            $table->string('level', '15');
            $table->string('exam_name');
            $table->string('subject');
            $table->string('institute_name')->nullable();
            $table->integer('roll')->nullable();
            $table->tinyInteger('course_duration')->nullable();
            $table->integer('passing_year');
            $table->string('board_or_university');
            $table->string('grade',20);
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
        Schema::dropIfExists('job_applicant_educations');
    }
}

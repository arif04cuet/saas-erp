<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_exam_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_circular_id');
            $table->unsignedInteger('job_application_id');
            $table->string('preliminary', 4)->nullable();
            $table->string('written', 4)->nullable();
            $table->string('aptitude', 4)->nullable();
            $table->string('viva', 4)->nullable();
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
        Schema::dropIfExists('recruitment_exam_marks');
    }
}

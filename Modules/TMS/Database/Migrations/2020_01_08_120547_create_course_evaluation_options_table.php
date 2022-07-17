<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEvaluationOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_evaluation_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_evaluation_questionnaire_id');
            $table->string('title_bn')->nullable();
            $table->string('title_en')->nullable();
            $table->double('mark');
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
        Schema::dropIfExists('course_evaluation_options');
    }
}

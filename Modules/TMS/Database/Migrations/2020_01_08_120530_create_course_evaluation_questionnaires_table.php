<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEvaluationQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_evaluation_questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_evaluation_sub_section_id');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->boolean('is_optional');
            $table->enum('type', ['radio', 'checkbox', 'text', 'textarea'])->default('radio');
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
        Schema::dropIfExists('course_evaluation_questionnaires');
    }
}

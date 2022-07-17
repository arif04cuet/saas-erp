<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEvaluationSubSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_evaluation_sub_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_evaluation_section_id');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->boolean('is_option_enable');
            $table->string('label_en')->nullable();
            $table->string('label_bn')->nullable();
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
        Schema::dropIfExists('course_evaluation_sub_sections');
    }
}

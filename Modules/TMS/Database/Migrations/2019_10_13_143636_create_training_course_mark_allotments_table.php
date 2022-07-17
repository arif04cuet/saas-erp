<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCourseMarkAllotmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_course_mark_allotments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_course_id');
            $table->unsignedInteger('training_course_mark_allotment_type_id');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('training_course_mark_allotments');
    }
}

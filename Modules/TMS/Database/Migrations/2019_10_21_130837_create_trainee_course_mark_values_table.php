<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraineeCourseMarkValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_course_mark_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trainee_id');
            $table->unsignedInteger('training_course_id');
            $table->unsignedInteger('training_course_mark_allotment_type_id');
            $table->double('value');
            $table->timestamps();
            $table->index(
                ['trainee_id', 'training_course_id', 'training_course_mark_allotment_type_id'],
                'trainee_course_mark_type_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainee_course_mark_values');
    }
}

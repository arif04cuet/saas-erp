<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCourseModuleBatchSessionSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_course_module_batch_session_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_course_module_session_id');
            $table->unsignedInteger('training_course_batch_id');
            $table->unsignedInteger('training_venue_id');
            $table->date('date');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->enum('status', ['scheduled', 'updated', 'completed'])->default('scheduled');
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
        Schema::dropIfExists('training_course_module_batch_session_schedules');
    }
}

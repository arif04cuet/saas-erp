<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCourseScheduledSessionsSpeakerEmailRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_course_scheduled_sessions_speaker_email_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_course_resource_id');
            $table->unsignedInteger('training_course_module_batch_session_schedule_id');
            $table->enum('status', ['pending', 'failed', 'completed'])->default('pending');
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
        Schema::dropIfExists('training_course_scheduled_sessions_speaker_email_recipients');
    }
}

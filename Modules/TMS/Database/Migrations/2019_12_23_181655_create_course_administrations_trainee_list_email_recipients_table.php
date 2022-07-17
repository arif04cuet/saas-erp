<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAdministrationsTraineeListEmailRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_administrations_trainee_list_email_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_course_module_batch_session_schedule_id');
            $table->enum('status', ['completed', 'failed', 'pending'])->default('pending');
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
        Schema::dropIfExists('course_administrations_trainee_list_email_recipients');
    }
}

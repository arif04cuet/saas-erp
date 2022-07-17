<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCourseModuleSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_course_module_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_course_module_id');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->double('mark')->default(0.00);
            $table->unsignedInteger('training_course_resource_id');
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
        Schema::dropIfExists('training_course_module_sessions');
    }
}

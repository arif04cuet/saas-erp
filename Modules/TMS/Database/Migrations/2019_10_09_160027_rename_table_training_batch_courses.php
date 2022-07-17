<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableTrainingBatchCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('training_batch_courses')) {
            Schema::rename('training_batch_courses', 'training_course_batches');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('training_course_batches')) {
            Schema::rename('training_course_batches', 'training_batch_courses');
        }
    }
}

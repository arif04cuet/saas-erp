<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableIntoTrainingCourseBatchRoomsFromTrainingBatchCourseRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('training_batch_course_rooms')) {
            Schema::rename('training_batch_course_rooms', 'training_course_batch_rooms');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('training_course_batch_rooms')) {
            Schema::rename('training_course_batch_rooms', 'training_batch_course_rooms');
        }
    }
}

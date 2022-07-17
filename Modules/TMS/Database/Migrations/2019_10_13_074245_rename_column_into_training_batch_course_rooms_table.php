<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnIntoTrainingBatchCourseRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_batch_course_rooms', function (Blueprint $table) {
            if(Schema::hasColumn('training_batch_course_rooms', 'training_batch_course_id')) {
                $table->renameColumn('training_batch_course_id', 'training_course_batch_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_batch_course_rooms', function (Blueprint $table) {
            if(Schema::hasColumn('training_batch_course_rooms', 'training_course_batch_id')) {
                $table->renameColumn('training_course_batch_id', 'training_batch_course_id');
            }
        });
    }
}

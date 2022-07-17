<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableTrainingCourseBatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_batches', function (Blueprint $table) {
            if(Schema::hasColumn('training_course_batches', 'batch_title')) {
                $table->renameColumn('batch_title', 'title');
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
        Schema::table('training_course_batches', function (Blueprint $table) {
            if(Schema::hasColumn('training_course_batches', 'title')) {
                $table->renameColumn('title', 'batch_title');
            }
        });
    }
}

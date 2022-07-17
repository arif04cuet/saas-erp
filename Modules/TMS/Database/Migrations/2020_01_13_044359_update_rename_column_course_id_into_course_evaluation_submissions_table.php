<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRenameColumnCourseIdIntoCourseEvaluationSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_evaluation_submissions', function (Blueprint $table) {
            if(Schema::hasColumn('course_evaluation_submissions', 'course_id')) {
                $table->renameColumn('course_id', 'training_course_id');
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
        Schema::table('course_evaluation_submissions', function (Blueprint $table) {
            if(Schema::hasColumn('course_evaluation_submissions', 'training_course_id')) {
                $table->renameColumn('training_course_id', 'course_id');
            }
        });
    }
}

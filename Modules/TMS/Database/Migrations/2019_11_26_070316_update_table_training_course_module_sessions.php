<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableTrainingCourseModuleSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_module_sessions', function (Blueprint $table) {
            DB::statement("ALTER TABLE training_course_module_sessions CHANGE COLUMN mark mark double default null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_course_module_sessions', function (Blueprint $table) {
            DB::statement("ALTER TABLE training_course_module_sessions CHANGE COLUMN mark mark double default 0.00");
        });
    }
}

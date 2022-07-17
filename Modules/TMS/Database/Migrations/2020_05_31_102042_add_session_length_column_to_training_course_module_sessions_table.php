<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSessionLengthColumnToTrainingCourseModuleSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('training_course_module_sessions', 'session_length')) {
            Schema::table('training_course_module_sessions', function (Blueprint $table) {
                $table->string('session_length')->after('mark')->default('1');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('training_course_module_sessions', 'session_length')) {
            Schema::table('training_course_module_sessions', function (Blueprint $table) {
                $table->dropColumn('session_length');
            });
        }
    }

}

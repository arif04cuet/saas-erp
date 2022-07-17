<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnSpeakerExpireTitmelineTableTrainingCourseModuleSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_module_sessions', function (Blueprint $table) {
            DB::statement("ALTER TABLE training_course_module_sessions CHANGE COLUMN speaker_expire_timeline speaker_expire_timeline int default 24");
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
            DB::statement("ALTER TABLE training_course_module_sessions CHANGE COLUMN speaker_expire_timeline speaker_expire_timeline int default null");
        });
    }
}

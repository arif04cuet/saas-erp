<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpeakerExpireTimelineToTrainingCourseModuleSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_module_sessions', function (Blueprint $table) {
            $table->integer('speaker_expire_timeline')->default(24);
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
            if(Schema::hasColumn('training_course_module_sessions', 'speaker_expire_timeline')) {
                $table->dropColumn('speaker_expire_timeline');
            }
        });
    }
}

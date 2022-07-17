<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSpeakerExpireTimelineToTrainingCourseModuleSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('evaluation:speaker-default-deadline', [
            'default' => 24
        ]);
        Schema::table('training_course_module_sessions', function (Blueprint $table) {
            $table->integer('speaker_expire_timeline')->default('24')->nullable(false)->change();
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
            $table->integer('speaker_expire_timeline')->default('24')->nullable()->change();
        });
    }
}

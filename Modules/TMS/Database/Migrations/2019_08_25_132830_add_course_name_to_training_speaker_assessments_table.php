<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseNameToTrainingSpeakerAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            if (!Schema::hasColumn('training_speaker_assessments', 'course_name')) {
                $table->string('course_name', 191);
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
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            if (Schema::hasColumn('training_speaker_assessments', 'course_name')) {
                $table->dropColumn('course_name');
            }
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReplaceSpeakerNameWithEmployeeIdInTrainingSpeakerAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            if (Schema::hasColumn('training_speaker_assessments', 'speaker_name')) {
                $table->dropColumn('speaker_name');
                $table->unsignedInteger('employee_id');
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
            if (Schema::hasColumn('training_speaker_assessments', 'employee_id')) {
                $table->dropColumn('employee_id');
                $table->string('speaker_name', 191)->nullable();
            }
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameClassNameToSessionNameInTrainingSpeakerAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            if (Schema::hasColumn('training_speaker_assessments', 'class_name')) {
                $table->renameColumn('class_name', 'session_name');
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
            if (Schema::hasColumn('training_speaker_assessments', 'session_name')) {
                $table->renameColumn('session_name', 'class_name');
            }
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingSpeakerAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            $table->unsignedInteger('trainee_id')->nullable();
            $table->string('speaker_name', 191)->nullable();
            $table->string('class_name', 191)->nullable();
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
            if (Schema::hasColumn('training_speaker_assessments', 'trainee_id')) {
                $table->dropColumn('trainee_id');
            }
            if (Schema::hasColumn('training_speaker_assessments', 'speaker_name')) {
                $table->dropColumn('speaker_name');
            }
            if (Schema::hasColumn('training_speaker_assessments', 'class_name')) {
                $table->dropColumn('class_name');
            }
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodPartsToTrainingSpeakerAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            if (!Schema::hasColumn('training_speaker_assessments', 'good_parts')) {
                $table->string('good_parts', 191);
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
            if (Schema::hasColumn('training_speaker_assessments', 'good_parts')) {
                $table->dropColumn('good_parts');
            }
        });
    }
}

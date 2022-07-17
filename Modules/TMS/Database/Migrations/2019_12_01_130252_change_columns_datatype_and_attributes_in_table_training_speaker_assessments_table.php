<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsDatatypeAndAttributesInTableTrainingSpeakerAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            $table->text('recommendation')->nullable()->change();
            $table->text('good_parts')->nullable()->change();
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
            $table->string('recommendation')->nullable(false)->change();
            $table->string('good_parts', 191)->nullable(false)->change();
        });
    }
}

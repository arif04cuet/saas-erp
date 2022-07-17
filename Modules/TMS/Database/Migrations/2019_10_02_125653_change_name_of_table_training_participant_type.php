<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameOfTableTrainingParticipantType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('training_participant_type')) {
            Schema::rename('training_participant_type', 'training_participant_types');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('training_participant_types')) {
            Schema::rename('training_participant_types', 'training_participant_type');
        }
    }
}

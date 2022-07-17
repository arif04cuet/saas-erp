<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaTitleAndBanglaLabelColumnInTrainingParticipantTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('training_participant_types', 'bangla_title')) {
            Schema::table('training_participant_types', function (Blueprint $table) {
                $table->string('bangla_title')->after('title')->nullable();
            });
        }
        if (!Schema::hasColumn('training_participant_types', 'bangla_label')) {
            Schema::table('training_participant_types', function (Blueprint $table) {
                $table->string('bangla_label')->after('label')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('training_participant_types', 'bangla_title')) {
            Schema::table('training_participant_types', function (Blueprint $table) {
                $table->dropColumn('bangla_title');
            });
        }
        if (Schema::hasColumn('training_participant_types', 'bangla_label')) {
            Schema::table('training_participant_types', function (Blueprint $table) {
                $table->dropColumn('bangla_label');
            });
        }


    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingHeadToTrainingParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasColumn('training_participants', 'training_head_id')) {
            Schema::table('training_participants', function (Blueprint $table) {
                $table->unsignedInteger('training_head_id')
                    ->after('training_id')
                    ->nullable();
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
        if (Schema::hasColumn('training_participants', 'training_head_id')) {
            Schema::table('training_participants', function (Blueprint $table) {
                $table->dropColumn('training_head_id');
            });
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingHeadIdToTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trainings', 'training_head_id')) {
            Schema::table('trainings', function (Blueprint $table) {
                $table->unsignedInteger('training_head_id')
                    ->after('uid')
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
        if (Schema::hasColumn('trainings', 'training_head_id')) {
            Schema::table('trainings', function (Blueprint $table) {
                $table->dropColumn('training_head_id');
            });
        }
    }
}

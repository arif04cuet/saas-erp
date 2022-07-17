<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingAndProjectIdInTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trips', 'training_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->unsignedInteger('training_id')->nullable()->after('billed_to');
            });
        }

        if (!Schema::hasColumn('trips', 'project_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->unsignedInteger('project_id')->nullable()->after('training_id');
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
        if (Schema::hasColumn('trips', 'training_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropColumn('training_id');
            });
        }

        if (Schema::hasColumn('trips', 'project_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropColumn('project_id');
            });
        }
    }
}

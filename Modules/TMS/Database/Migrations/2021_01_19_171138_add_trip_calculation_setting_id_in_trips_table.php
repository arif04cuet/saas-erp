<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTripCalculationSettingIdInTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trips', 'trip_calculation_setting_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->unsignedInteger('trip_calculation_setting_id')
                    ->after('requester_id')
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
        if (Schema::hasColumn('trips', 'trip_calculation_setting_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropColumn('trip_calculation_setting_id');
            });
        }
    }
}

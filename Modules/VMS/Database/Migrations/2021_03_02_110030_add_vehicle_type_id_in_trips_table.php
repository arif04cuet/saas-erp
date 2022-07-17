<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVehicleTypeIdInTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trips', 'vehicle_type_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->unsignedInteger('vehicle_type_id')->after('requester_id');
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
        if (Schema::hasColumn('trips', 'vehicle_type_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropColumn('vehicle_type_id');
            });
        }
    }
}

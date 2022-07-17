<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequesterIdToVehicleFuelBillSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('vehicle_fuel_bill_submits','requester_id')) {
            Schema::table('vehicle_fuel_bill_submits', function (Blueprint $table) {
                $table->unsignedInteger('requester_id')->nullable(false)->after('id');
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
        if (Schema::hasColumn('vehicle_fuel_bill_submits','requester_id')) {
            Schema::table('vehicle_fuel_bill_submits', function (Blueprint $table) {
                $table->dropColumn('requester_id');
            });
        }
    }
}

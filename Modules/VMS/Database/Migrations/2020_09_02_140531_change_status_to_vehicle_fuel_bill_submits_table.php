<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusToVehicleFuelBillSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('vehicle_fuel_bill_submits','status')) {
            Schema::table('vehicle_fuel_bill_submits', function (Blueprint $table) {
                $table->string('status',30)->default('pending')->change();
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
        if (Schema::hasColumn('vehicle_fuel_bill_submits','status')) {
            Schema::table('vehicle_fuel_bill_submits', function (Blueprint $table) {
                $table->string('status')->default('pending')->change();
            });
        }
    }
}

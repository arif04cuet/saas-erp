<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumTotalAmountToVehicleMaintenanceRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('vehicle_maintenance_requisitions','total_amount')) {
            Schema::table('vehicle_maintenance_requisitions', function (Blueprint $table) {
                $table->float('total_amount',8,2)->nullable()->after('status');
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
        if (Schema::hasColumn('vehicle_maintenance_requisitions','total_amount')) {
            Schema::table('vehicle_maintenance_requisitions', function (Blueprint $table) {
                $table->dropColumn('total_amount');
            });
        }
    }
}

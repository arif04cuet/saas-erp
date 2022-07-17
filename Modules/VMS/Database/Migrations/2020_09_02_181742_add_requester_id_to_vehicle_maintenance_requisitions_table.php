<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequesterIdToVehicleMaintenanceRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('vehicle_maintenance_requisitions','requester_id')) {
            Schema::table('vehicle_maintenance_requisitions', function (Blueprint $table) {
                $table->unsignedInteger('requester_id')->nullable()->after('id');
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
        if (Schema::hasColumn('vehicle_maintenance_requisitions','requester_id')) {
            Schema::table('vehicle_maintenance_requisitions', function (Blueprint $table) {
                $table->dropColumn('total_amount');
            });
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusToVehicleMaintenanceRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('vehicle_maintenance_requisitions','status')) {
            Schema::table('vehicle_maintenance_requisitions', function (Blueprint $table) {
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
        if (Schema::hasColumn('vehicle_maintenance_requisitions','status')) {
            Schema::table('vehicle_maintenance_requisitions', function (Blueprint $table) {
                $table->string('status')->default('pending')->change();
            });
        }
    }
}

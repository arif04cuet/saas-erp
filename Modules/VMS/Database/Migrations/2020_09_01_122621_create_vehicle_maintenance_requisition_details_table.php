<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleMaintenanceRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_maintenance_requisition_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requisition_id')->nullable(false);
            $table->string('item_id')->nullable(false);
            $table->float('quantity',8,2)->nullable(false);
            $table->float('price',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_maintenance_requisition_details');
    }
}

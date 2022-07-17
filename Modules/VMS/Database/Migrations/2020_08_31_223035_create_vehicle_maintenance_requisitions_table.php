<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleMaintenanceRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_maintenance_requisitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requisition')->nullable(false);
            $table->string('vehicle_id')->nullable();
            $table->date('date')->nullable(false);
            $table->integer('driver_id')->nullable(false);
            $table->integer('status')->default(0);
            $table->integer('update_by')->unsigned()->nullable();
            $table->integer('approve_by')->unsigned()->nullable();
            $table->dateTime('approve_date')->nullable();
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
        Schema::dropIfExists('vehicle_maintenance_requisitions');
    }
}

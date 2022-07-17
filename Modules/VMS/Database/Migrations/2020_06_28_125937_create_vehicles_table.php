<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vehicle_type_id')->nullable(false);
            $table->string('unique_id')->unique();
            $table->string('name');
            $table->string('model');
            $table->string('registration_number');
            $table->string('price');
            $table->string('seat');
            $table->string('cc');
            $table->string('chassis_number');
            $table->date('purchase_date');
            $table->string('status')->default(\Modules\VMS\Entities\Vehicle::getStatuses()['available']);
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
        Schema::dropIfExists('vehicles');
    }
}

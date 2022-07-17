<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleFuelBillSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_fuel_bill_submits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('requester_id')->nullable(false);
            $table->unsignedInteger('filling_station_id')->nullable(false);
            $table->date('date');
            $table->float('amount', 8, 2)->nullable(false);
            $table->string('voucher_number',20)->nullable();
            $table->string('acknowledgement_one')->nullable(false);
            $table->string('acknowledgement_two')->nullable();
            $table->string('status',30)->default('pending');
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
        Schema::dropIfExists('vehicle_fuel_bill_submits');
    }
}

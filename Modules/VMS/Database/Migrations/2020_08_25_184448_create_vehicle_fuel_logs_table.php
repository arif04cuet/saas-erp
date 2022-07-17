<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleFuelLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_fuel_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vehicle_id')->nullable(false);
            $table->unsignedInteger('vehicle_type_id')->nullable(false);
            $table->unsignedInteger('filling_station_id')->nullable(false);
            $table->date('date');
            $table->decimal('fuel_quantity', 8, 2)->nullable(false);
            $table->string('fuel_type', 200)->nullable(false);
            $table->float('amount', 8, 2)->nullable(false);
            $table->string('voucher_number',20)->nullable();
            $table->string('acknowledgement_slip')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('vehicle_fuel_logs');
    }
}

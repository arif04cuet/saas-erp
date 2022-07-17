<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleFillingStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_filling_stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->unique();
            $table->string('address',255)->nullable();
            $table->string('contact_person_name',60)->nullable();
            $table->string('contact_person_mobile',13)->nullable();
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
        Schema::dropIfExists('vehicle_filling_stations');
    }
}

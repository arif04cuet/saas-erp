<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicalFacilityRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_facility_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requester_name');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('organization')->nullable();
            $table->string('training')->nullable();
            $table->string('status')->default('pending');

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
        Schema::dropIfExists('physical_facility_requests');
    }
}

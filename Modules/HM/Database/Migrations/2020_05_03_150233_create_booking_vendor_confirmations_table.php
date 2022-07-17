<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingVendorConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_vendor_confirmations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', array('pending', 'approved', 'rejected'));
            $table->string('unique_key')->unique()->nullable();
            $table->date('last_validity');
            $table->unsignedInteger('physical_facility_request_id');
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
        Schema::dropIfExists('booking_vendor_confirmations');
    }
}

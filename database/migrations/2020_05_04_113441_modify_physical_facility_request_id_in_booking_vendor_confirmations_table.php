<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPhysicalFacilityRequestIdInBookingVendorConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_vendor_confirmations', function (Blueprint $table) {
            $table->unique('physical_facility_request_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_vendor_confirmations', function (Blueprint $table) {
            $table->unsignedInteger('physical_facility_request_id')->change();
        });
    }
}

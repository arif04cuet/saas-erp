<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToRoomBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_bookings', function (Blueprint $table) {
            $table->unsignedInteger('physical_facility_request_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hascolumn('room_bookings', 'physical_facility_request_id')){
            Schema::table('room_bookings', function (Blueprint $table) {
                $table->dropColumn('physical_facility_request_id');
            });
        }
    }
}

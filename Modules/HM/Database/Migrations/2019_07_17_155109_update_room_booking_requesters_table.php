<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoomBookingRequestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_booking_requesters', function (Blueprint $table) {
            DB::statement("ALTER TABLE room_booking_requesters CHANGE COLUMN organization_type organization_type ENUM('government_official', 'government_personal', 'non_government', 'international', 'bard', 'others') DEFAULT NULL ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_booking_requesters', function (Blueprint $table) {
            DB::statement("ALTER TABLE room_booking_requesters CHANGE COLUMN organization_type organization_type ENUM('government', 'private', 'foreign', 'others') DEFAULT NULL ");
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNationalityToRoomBookingGuestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_guest_infos', function (Blueprint $table) {
            $table->string('nationality')->default(trans('hm::booking-request.bengali'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_guest_infos', function (Blueprint $table) {
            $table->dropColumn('nationality');
        });
    }
}

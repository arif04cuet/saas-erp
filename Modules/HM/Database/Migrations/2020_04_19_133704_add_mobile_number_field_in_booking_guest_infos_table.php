<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileNumberFieldInBookingGuestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_guest_infos', function (Blueprint $table) {
            $table->integer('mobile_number')->nullable()->after('address');
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
            if (Schema::hasColumn('booking_guest_infos', 'mobile_number')) {
                $table->dropColumn('mobile_number');
            }
        });
    }
}

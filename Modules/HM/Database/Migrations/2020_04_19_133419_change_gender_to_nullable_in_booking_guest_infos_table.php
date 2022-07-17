<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGenderToNullableInBookingGuestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_guest_infos', function (Blueprint $table) {
            // doctrine package do not support changing column type of "enum" [ from the laravel doc]
            // so changing manually
            $status = Config('hm.booking_guest_info.gender');
            $genderOptionString = implode("','", $status);
            $query = "ALTER TABLE booking_guest_infos CHANGE COLUMN gender gender enum ('" . $genderOptionString . "') NULL";
            DB::statement($query);
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
            // enum->gender
            $status = Config('hm.booking_guest_info.gender');
            $genderOptionString = implode("','", $status);
            $query = "ALTER TABLE booking_guest_infos CHANGE COLUMN gender gender enum ('" . $genderOptionString . "')  NOT NULL";
            DB::statement($query);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckinDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkin_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('checkin_id');
            $table->integer('booking_guest_info_id');
            $table->integer('room_id');
            $table->dateTime('checkin_date');
            $table->dateTime('checkout_date')->nullable();
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
        Schema::dropIfExists('checkin_details');
    }
}

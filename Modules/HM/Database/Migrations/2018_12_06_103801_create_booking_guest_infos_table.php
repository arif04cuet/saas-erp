<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingGuestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_guest_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_booking_id');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->unsignedInteger('age')->default(0);
            $table->enum('gender', ['male', 'female']);
            $table->string('relation');
            $table->string('nid_no')->nullable();
            $table->string('nid_doc')->nullable();
            $table->string('address');
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
        Schema::dropIfExists('booking_guest_infos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('actual_end_date')->nullable();
            $table->string('shortcode');
            $table->enum('booking_type', ['general', 'training', 'venue']);
            $table->enum('status', ['approved', 'pending', 'rejected']);
            $table->string('note')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->enum('type', ['booking', 'checkin'])->default('booking');
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
        Schema::dropIfExists('room_bookings');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckinRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkin_room', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkin_id');
            $table->integer('room_id');
            $table->enum('status', ['checkedin', 'checkedout'])->default('checkedin');
            $table->dateTime('checkin_date')->default(date('y-m-d H:i:s'));
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
        Schema::dropIfExists('checkin_room');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomBookingRequestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_booking_requesters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_booking_id');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->enum('gender', ['male', 'female']);
            $table->string('contact');
            $table->string('address', 300);
            $table->string('email', 50)->nullable();
            $table->string('nid')->nullable();
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->enum('organization_type', ['government', 'private', 'foreign', 'others'])->nullable();
            $table->string('org_address')->nullable();
            $table->string('photo')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('nid_doc')->nullable();
            $table->string('passport_doc')->nullable();
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
        Schema::dropIfExists('room_booking_requesters');
    }
}

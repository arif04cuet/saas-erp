<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('requester_id');
            $table->integer('no_of_passenger')->default(0);
            $table->string('destination')->nullable(false);
            $table->string('type')->nullable();
            $table->float('distance')->default(0.0);
            $table->float('completed_distance')->default(0.0);
            $table->dateTime('start_date_time');
            $table->dateTime('actual_start_date_time')->nullable();
            $table->dateTime('end_date_time');
            $table->dateTime('actual_end_date_time')->nullable();
            $table->text('reason')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('trips');
    }
}

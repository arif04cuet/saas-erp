<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckinPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkin_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('checkin_id');
            $table->string('shortcode', 10);
            $table->double('amount', 8, 2);
            $table->enum('type', ['cash', 'card', 'check']);
            $table->string('check_number', 11)->nullable();
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
        Schema::dropIfExists('checkin_payments');
    }
}

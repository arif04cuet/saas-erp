<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_billings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('order_no')->unique();
            $table->integer('vendor_id');
            $table->integer('to_location_id');
            $table->dateTime('bill_date');
            $table->string('status', 20)->default('draft');
            $table->integer('bill_setting_id');

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
        Schema::dropIfExists('procurement_billings');
    }
}

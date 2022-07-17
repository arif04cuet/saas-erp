<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CafeteriaFoodOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafeteria_food_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('order_date');
            $table->integer('requester');
            $table->string('reference_type');
            $table->integer('bill_to');
            $table->string('status')->default('pending');
            $table->double('paid_amount')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('cafeteria_food_orders');
    }
}

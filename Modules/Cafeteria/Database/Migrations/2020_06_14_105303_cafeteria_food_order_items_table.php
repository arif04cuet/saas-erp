<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CafeteriaFoodOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafeteria_food_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cafeteria_food_order_id');
            $table->unsignedInteger('raw_material_id');
            $table->integer('quantity');
            $table->unsignedInteger('unit_id');
            $table->double('unit_price')->nullable();
            $table->double('vat')->nullable();
            $table->double('total_price')->nullable();
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
        Schema::dropIfExists('cafeteria_food_order_items');
    }
}

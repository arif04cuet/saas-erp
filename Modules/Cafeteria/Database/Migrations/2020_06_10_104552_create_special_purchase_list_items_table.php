<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialPurchaseListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_purchase_list_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('special_purchase_list_id');
            $table->unsignedInteger('raw_material_id');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('total_price');
            
            $table->foreign('special_purchase_list_id')->references('id')->on('special_purchase_lists')->onDelete('cascade');
            $table->foreign('raw_material_id')->references('id')->on('raw_materials')->onDelete('cascade');
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
        Schema::dropIfExists('special_purchase_list_items');
    }
}

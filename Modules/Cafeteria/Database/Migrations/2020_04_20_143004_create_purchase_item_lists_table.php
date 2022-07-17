<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_item_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_list_id');
            $table->unsignedInteger('raw_material_id');
            $table->integer('quantity');
            $table->unsignedInteger('unit_id');
            $table->integer('unit_price');
            $table->text('total_price');
            $table->string('status');

            $table->foreign('purchase_list_id')->references('id')->on('purchase_lists')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_item_lists');
    }
}

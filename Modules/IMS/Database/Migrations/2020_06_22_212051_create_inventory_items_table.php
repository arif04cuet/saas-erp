<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_item_category_id');
            $table->integer('inventory_location_id')->nullable();
            $table->string('unique_id')->unique();
            $table->string('title');
            $table->string('model')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->default('inactive');

            $table->softDeletes();
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
        Schema::dropIfExists('inventory_items');
    }
}

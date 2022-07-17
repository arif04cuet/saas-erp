<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inventory_item_request_details')) {
            Schema::create('inventory_item_request_details', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('inventory_item_request_id');
                $table->unsignedInteger('inventory_item_category_id');
                $table->double('quantity');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_item_request_details');
    }
}

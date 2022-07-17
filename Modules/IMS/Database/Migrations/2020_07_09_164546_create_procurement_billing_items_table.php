<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementBillingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_billing_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procurement_billing_id');
            $table->string('code');
            $table->integer('inventory_item_category_id');
            $table->string('item_name')->nullable();
            $table->integer('quantity');
            $table->double('unit_price', 12,2);
            $table->double('vat', 12,2);

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
        Schema::dropIfExists('procurement_billing_items');
    }
}

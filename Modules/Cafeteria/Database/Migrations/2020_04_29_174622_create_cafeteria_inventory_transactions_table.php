<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafeteriaInventoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafeteria_inventory_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_table');
            $table->integer('reference_table_id');
            $table->date('date');
            $table->unsignedInteger('cafeteria_inventory_id');
            $table->integer('quantity');
            $table->string('status');
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
        Schema::dropIfExists('cafeteria_inventory_transactions');
    }
}

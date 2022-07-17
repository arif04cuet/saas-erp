<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationInventoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_inventory_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_table')->nullable();
            $table->unsignedInteger('reference_table_id')->nullable();
            $table->date('date');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('publication_inventory_id');
            //$table->foreign('publication_inventory_id')->references('id')->on('publication_inventories')->onDelete('cascade');
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
        Schema::dropIfExists('publication_inventory_transactions');
    }
}

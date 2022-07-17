<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MedicineInventoryForeignKeyAddTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_inventories', function (Blueprint $table) {
            $table->foreign('medicine_id','fk_medicine_inventory_medicine_id')->references('id')->on('medicines')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_inventories', function(Blueprint $table)
        {
            $table->dropForeign('fk_medicine_inventory_medicine_id');
        });

    }
}

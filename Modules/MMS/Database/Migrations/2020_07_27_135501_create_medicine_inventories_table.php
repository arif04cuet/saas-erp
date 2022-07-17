<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('medicine_inventories');
        Schema::create('medicine_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id')->unique()->unsigned();
            $table->integer('quantity');
            $table->integer('previous_quantity')->nullable();
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
        Schema::dropIfExists('medicine_inventories');
    }
}

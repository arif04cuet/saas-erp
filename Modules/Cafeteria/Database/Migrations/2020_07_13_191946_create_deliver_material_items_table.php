<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverMaterialItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliver_material_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('deliver_material_id');
            $table->unsignedInteger('raw_material_id');
            $table->integer('quantity');
            $table->string('status');

            $table->foreign('deliver_material_id')->references('id')->on('deliver_materials')->onDelete('cascade');
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
        Schema::dropIfExists('deliver_material_items');
    }
}

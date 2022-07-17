<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemAppreciationDepreciationRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_appreciation_depreciation_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_item_id');
            $table->string('type');
            $table->double('value', 14, 2);
            $table->string('reason');
            $table->date('evaluation_date');
            $table->integer('created_by');

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
        Schema::dropIfExists('item_appreciation_depreciation_records');
    }
}

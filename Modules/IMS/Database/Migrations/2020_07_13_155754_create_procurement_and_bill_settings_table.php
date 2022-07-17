<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementAndBillSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_and_bill_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->tinyInteger('vat_percentage');
            $table->integer('vat_economy_code');
            $table->integer('items_economy_code');
            $table->integer('journal_id');
            $table->string('bill_type', 20);
            $table->boolean('is_default');
            $table->string('status', 20)->default('active');
            $table->text('remark')->nullable();

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
        Schema::dropIfExists('procurement_and_bill_settings');
    }
}

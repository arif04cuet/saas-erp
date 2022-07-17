<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_cost_segmentations', function (Blueprint $table) {
            $table->id();
            $table->string('cost_type_id');
            $table->string('cost_detail');
            $table->string('unit_number');
            $table->decimal('unit_price');
            $table->decimal('vat');
            $table->decimal('tax');
            $table->decimal('total_amount');
            $table->decimal('total_cost');
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
        Schema::dropIfExists('training_cost_segmentations');
    }
};

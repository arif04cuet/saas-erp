<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePensionRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pension_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pension_configuration_id');
            $table->string('name');
            $table->string('type')->default('bonus');
            $table->string('condition');
            $table->string('amount_type');
            $table->double('percentage_amount')->nullable();
            $table->double('fixed_amount')->nullable();
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
        Schema::dropIfExists('pension_rules');
    }
}

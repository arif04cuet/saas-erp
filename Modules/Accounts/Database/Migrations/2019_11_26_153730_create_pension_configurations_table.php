<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePensionConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pension_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable(false);
            $table->integer('percentage')->default(90);
            $table->integer('lump_sum_number')->default(230);
            $table->integer('lump_sum_percentage')->default(50);
            $table->integer('monthly_pension_percentage')->default(50);
            $table->integer('minimum_pension_amount')->default(3000);
            $table->integer('medical_allowance_increment_age')->default(65);
            $table->integer('initial_medical_allowance')->default(1500);
            $table->integer('medical_allowance_after_increment')->default(2500);
            $table->enum('status', \Modules\Accounts\Entities\PensionConfiguration::status)
                ->default(\Modules\Accounts\Entities\PensionConfiguration::status[1]);
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
        Schema::dropIfExists('pension_configurations');
    }
}

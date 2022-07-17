<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetCostCenterSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_cost_center_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_cost_center_id');
            $table->string('title');
            $table->unsignedInteger('economy_sector_code');
            $table->string('sequence')->nullable();
            $table->double('budget_amount');

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
        Schema::dropIfExists('budget_cost_center_sectors');
    }
}

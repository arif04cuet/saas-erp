<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetCostCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_cost_centers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('economy_code');
            $table->integer('accounts_budget_id');
            $table->double('budget_amount');
            $table->string('status', 20)->default('draft');

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
        Schema::dropIfExists('budget_cost_centers');
    }
}

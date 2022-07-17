<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsBudgetSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_budget_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accounts_budget_id');
            $table->integer('code');
            $table->double('local_amount');
            $table->integer('revenue_amount');
            $table->integer('revised_local_amount')->nullable();
            $table->integer('revised_revenue_amount')->nullable();

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
        Schema::dropIfExists('accounts_budget_sectors');
    }
}

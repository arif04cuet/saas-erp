<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsBudgetSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_budget_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tms_budget_id');
            $table->integer('tms_sub_sector_id');
            $table->tinyInteger('no_of_days')->nullable();
            $table->tinyInteger('no_of_person')->nullable();
            $table->double('rate');
            $table->double('total');
            $table->double('revised_rate')->nullable();
            $table->double('revised_total')->nullable();
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('tms_budget_sectors');
    }
}

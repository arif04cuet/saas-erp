<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsAccountBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_account_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_id')->nullable(false);
            $table->unsignedInteger('tms_sub_sector_id')->nullable(false);
            $table->double('total_receive_amount')->default(0.0);
            $table->double('total_payment_amount')->default(0.0);
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
        Schema::dropIfExists('tms_account_balances');
    }
}

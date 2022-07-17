<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpfLoanDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpf_loan_deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gpf_loan_id');
            $table->double('amount');
            $table->double('loan_balance');
            $table->date('deposit_date');
            $table->string('remarks')->nullable();
            $table->string('check_or_trx_no')->nullable();

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
        Schema::dropIfExists('gpf_loan_deposits');
    }
}

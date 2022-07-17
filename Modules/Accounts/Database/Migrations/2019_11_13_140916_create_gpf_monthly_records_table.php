<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpfMonthlyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpf_monthly_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('payslip_id');
            $table->integer('gpf_stock_amount');
            $table->integer('gpf_amount');
            $table->integer('gpf_advanced_amount');
            $table->integer('gpf_balance');
            $table->integer('loan_balance');
            $table->double('interest');
            $table->string('month',10);

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
        Schema::dropIfExists('gpf_monthly_records');
    }
}

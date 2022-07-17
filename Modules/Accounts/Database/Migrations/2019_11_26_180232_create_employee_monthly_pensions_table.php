<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeMonthlyPensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_monthly_pensions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('receiver');
            $table->string('month', 10);
            $table->date('disburse_date')->nullable();
            $table->double('basic_pay');
            $table->integer('medical_allowance');
            $table->double('bonus')->nullable();
            $table->string('bonus_name')->nullable();
            $table->double('total');
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
        Schema::dropIfExists('employee_monthly_pensions');
    }
}

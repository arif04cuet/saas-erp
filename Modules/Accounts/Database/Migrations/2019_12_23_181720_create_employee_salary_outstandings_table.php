<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Accounts\Entities\EmployeeSalaryOutstanding;

class CreateEmployeeSalaryOutstandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_outstandings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id')->nullable(false);
            $table->integer('salary_rule_id')->nullable(false);
            $table->dateTime('month')->nullable(false);
            $table->integer('amount')->nullable()->default(0);
            $table->string('remark')->nullable();
            $table->enum('status', EmployeeSalaryOutstanding::STATUS)->default(EmployeeSalaryOutstanding::STATUS[1]);
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
        Schema::dropIfExists('employee_salary_outstandings');
    }
}

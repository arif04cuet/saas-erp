<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_loan_circular_id');
            $table->integer('employee_id');
            $table->string('type');
            $table->double('amount')->nullable();
            $table->integer('installment')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('reason');
            $table->string('remarks')->nullable();
            $table->string('attachment')->nullable();
            $table->string('previous_loans')->nullable();
            $table->boolean('association_loan')->default(false);
            $table->string('association_loan_amount')->nullable();
            $table->boolean('bank_loan')->default(false);
            $table->string('bank_name')->nullable();
            $table->string('bank_loan_amount')->nullable();
            $table->string('status')->default('pending');
            $table->integer('created_by');
            $table->dateTime('approval_date')->nullable();

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
        Schema::dropIfExists('employee_loans');
    }
}

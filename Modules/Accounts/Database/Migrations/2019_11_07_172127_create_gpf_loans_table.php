<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpfLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpf_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('amount');
            $table->integer('current_balance')->nullable();
            $table->integer('no_of_installment');
            $table->date('sanction_date');
            $table->date('payment_date')->nullable();
            $table->string('remark')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('gpf_loans');
    }
}

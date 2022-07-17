<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsAdvancePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_advance_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id')->nullable(false);
            $table->unsignedInteger('training_id')->nullable();
            $table->unsignedInteger('tms_journal_entry_id')->nullable(false);
            $table->double('total_debit_amount')->default(0.0);
            $table->double('total_credit_amount')->default(0.0);
            $table->date('date');
            $table->enum('status', config('tms.constants.accounts.statuses'))
                ->default(config('tms.constants.accounts.statuses')[0]);
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
        Schema::dropIfExists('tms_advance_payments');
    }
}

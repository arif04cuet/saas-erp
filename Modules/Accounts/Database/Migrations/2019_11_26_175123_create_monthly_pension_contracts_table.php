<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyPensionContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_pension_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('receiver', 20)
                ->default(array_keys(config('constants.pension.contract.receiver_type'))[0]);
            $table->double('initial_basic');
            $table->double('current_basic');
            $table->integer('increment')->default(0);
            $table->integer('increment_percentage')->default(5);
            $table->string('disbursement_type');
            $table->string('bank_account_information')->nullable();
            $table->string('status', 20)->default('inactive');

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
        Schema::dropIfExists('monthly_pension_contracts');
    }
}

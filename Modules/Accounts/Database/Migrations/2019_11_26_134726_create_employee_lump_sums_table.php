<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Accounts\Entities\EmployeeLumpSum;

class CreateEmployeeLumpSumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_lump_sums', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id')->nullable(false)->unique();
            $table->integer('basic_salary')->nullable(false);
            $table->integer('eligible_pension')->nullable(false);
            $table->integer('monthly_pension')->nullable(false);
            $table->integer('lump_sum_amount')->default(0);
            $table->enum('status', EmployeeLumpSum::status)->default(EmployeeLumpSum::status[0]);
            $table->enum('receiver', array_keys(config('constants.pension.contract.receiver_type')))
                ->default(array_keys(config('constants.pension.contract.receiver_type'))[0]);
            $table->integer('nominee_id')->nullable();
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
        Schema::dropIfExists('employee_lump_sums');
    }
}

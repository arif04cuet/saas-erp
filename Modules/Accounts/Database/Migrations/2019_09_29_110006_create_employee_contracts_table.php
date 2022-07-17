<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference');
            $table->integer('employee_id');
            $table->integer('salary_structure_id');
            $table->tinyInteger('salary_grade');
            $table->tinyInteger('increment')->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('probation_end')->nullable();
            $table->integer('hr_responsible')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->tinyInteger('house_allotment')->default(0);
            $table->tinyInteger('car_facility')->default(0);

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
        Schema::dropIfExists('employee_contracts');
    }
}

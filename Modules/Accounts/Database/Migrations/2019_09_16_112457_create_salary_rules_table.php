<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('bangla_name')->nullable();
            $table->string('salary_category_id')->nullable(false);
            $table->string('code')->unique();
            $table->string('sequence');
            $table->integer('debit_account')->nullable();
            $table->integer('credit_account')->nullable();
            $table->tinyInteger('show_on_payslip')->nullable();
            $table->string('condition_type');
            $table->string('range_based_on')->nullable();
            $table->string('max_range')->nullable();
            $table->string('min_range')->nullable();
            $table->text('condition_expression')->nullable();
            $table->string('amount_type');
            $table->string('percentage_based_on')->nullable();
            $table->float('quantity');
            $table->float('percentage')->nullable();
            $table->float('fixed_amount')->nullable();
            $table->string('contribution_register')->nullable();

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
        Schema::dropIfExists('salary_rules');
    }
}

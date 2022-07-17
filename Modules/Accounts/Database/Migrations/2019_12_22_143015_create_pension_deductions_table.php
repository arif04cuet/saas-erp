<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Accounts\Entities\PensionDeduction;

class CreatePensionDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pension_deductions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->string('bangla_name')->nullable();
            $table->enum('pension_deduction_type', PensionDeduction::PENSION_DEDUCTION_TYPE)
                ->default(PensionDeduction::PENSION_DEDUCTION_TYPE[0]);
            $table->string('economy_code')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('pension_deductions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToEmployeeMonthlyPensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('employee_monthly_pensions', 'deduction')) {
            Schema::table('employee_monthly_pensions', function (Blueprint $table) {
                $table->double('deduction')->nullable()->after('bonus');
                $table->string('remarks')->nullable()->after('total');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('employee_monthly_pensions', 'deduction')) {
            Schema::table('employee_monthly_pensions', function (Blueprint $table) {
                $table->dropColumn('deduction');
                $table->dropColumn('remarks');
            });
        }
    }
}

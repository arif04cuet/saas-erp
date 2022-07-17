<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMonthlyPensionContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('monthly_pension_contracts', 'ppo_number')) {
            Schema::table('monthly_pension_contracts', function (Blueprint $table) {
                $table->string('ppo_number')->after('id');
                $table->integer('nominee_id')->after('receiver')->nullable();
                $table->tinyInteger('has_payroll_increment')->after('nominee_id')->default(0);
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
        if (Schema::hasColumn('monthly_pension_contracts', 'ppo_number')) {
            Schema::table('monthly_pension_contracts', function (Blueprint $table) {
                $table->dropColumn('ppo_number');
                $table->dropColumn('nominee_id');
                $table->dropColumn('has_payroll_increment');
            });
        }
    }
}

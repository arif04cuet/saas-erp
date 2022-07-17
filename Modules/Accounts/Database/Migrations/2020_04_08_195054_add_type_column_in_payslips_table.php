<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnInPayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payslips', function (Blueprint $table) {
            $table->enum('type', \Modules\Accounts\Entities\Payslip::getTypes())
                ->default(\Modules\Accounts\Entities\Payslip::getTypes()[0])
                ->after('reference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('payslips', 'type')) {
            Schema::table('payslips', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
}

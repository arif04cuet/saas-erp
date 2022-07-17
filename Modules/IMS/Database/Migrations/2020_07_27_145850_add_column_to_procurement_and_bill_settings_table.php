<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToProcurementAndBillSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('procurement_and_bill_settings', 'it_economy_code')) {
            Schema::table('procurement_and_bill_settings', function (Blueprint $table) {
                $table->integer('it_economy_code')->after('vat_economy_code');
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
        if (Schema::hasColumn('procurement_and_bill_settings', 'it_economy_code')) {
            Schema::table('procurement_and_bill_settings', function (Blueprint $table) {
                $table->dropColumn('it_economy_code');
            });
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItColumnToProcurementBillingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('procurement_billing_items', 'it')) {
            Schema::table('procurement_billing_items', function (Blueprint $table) {
                $table->double('it', 13, 2)->after('vat')->default('0');
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
        if (Schema::hasColumn('procurement_billing_items', 'it')) {
            Schema::table('procurement_billing_items', function (Blueprint $table) {
                $table->dropColumn('it');
            });
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnitPriceColumnToInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('inventory_items', 'unit_price')) {
            Schema::table('inventory_items', function (Blueprint $table) {
                $table->double('unit_price', 12, 2)->after('model')->default('0.00');
                $table->integer('created_by')->nullable();
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
        if (Schema::hasColumn('inventory_items', 'unit_price')) {
            Schema::table('inventory_items', function (Blueprint $table) {
                $table->dropColumn('unit_price');
                $table->dropColumn('created_by');
            });
        }
    }
}

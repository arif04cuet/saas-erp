<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueIdColumnToInventoryItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('inventory_item_categories', 'unique_id')) {
            Schema::table('inventory_item_categories', function (Blueprint $table) {
                $table->string('unique_id', 50)->after('id');
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
        if (Schema::hasColumn('inventory_item_categories', 'unique_id')) {
            Schema::table('inventory_item_categories', function (Blueprint $table) {
                $table->dropColumn('unique_id');
            });
        }
    }
}

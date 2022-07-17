<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupIdToInventoryItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_item_categories', function (Blueprint $table) {
            $table->integer('group_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasColumn('inventory_item_categories', 'group_id')) {
            Schema::table('inventory_item_categories', function (Blueprint $table) {
                $table->dropColumn('group_id');
            });
        }
    }
}

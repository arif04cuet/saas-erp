<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToinventoryItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_item_categories', function (Blueprint $table) {
            $table->string('type')->after('short_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('inventory_item_categories', 'type')) {
            Schema::table('inventory_item_categories', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
}

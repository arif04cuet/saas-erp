<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedPurchaseDateColumnInPurchaseItemListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_item_lists', function(Blueprint $table) {
            if (!Schema::hasColumn('purchase_item_lists', 'purchase_date')) {
                $table->date('purchase_date')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_item_lists', function(Blueprint $table) {
            if (Schema::hasColumn('purchase_item_lists', 'purchase_date')) {
               $table->dropColumn('purchase_date'); 
            };
        });
    }
}

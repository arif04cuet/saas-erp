<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentDuetotalColumnInSpecialPurchaseListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('special_purchase_lists', function (Blueprint $table) {
            if (!Schema::hasColumn('special_purchase_lists', 'payment')) {
                $table->integer('payment');
                $table->integer('due_total');
            }
            $table->text('remark')->nullable()->change();

            $table->foreign('special_group_id')->references('id')->on('special_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('special_purchase_lists', 'payment')) {
            Schema::table('special_purchase_lists', function (Blueprint $table) {
                $table->dropColumn('payment');
                $table->dropColumn('due_total');
            });   
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalDueDateColumnAtSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            if (!Schema::hasColumn('sales', 'paid')) {
                $table->integer('paid')->nullable();
                $table->integer('due')->nullable();
                $table->date('sales_date')->nullable();
                $table->string('status')->nullable()->default(null)->change();
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
        Schema::table('sales', function (Blueprint $table) {
            if (Schema::hasColumn('sales', 'paid')) {
                $table->dropColumn('paid');
                $table->dropColumn('due');
                $table->dropColumn('sales_date');
            }
        });
    }
}

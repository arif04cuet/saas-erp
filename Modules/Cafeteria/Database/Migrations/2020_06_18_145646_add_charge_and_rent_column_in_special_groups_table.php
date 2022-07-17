<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChargeAndRentColumnInSpecialGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('special_groups', function (Blueprint $table) {
            $table->integer('charge');
            $table->integer('rent')->nullable();
            $table->text('remark')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_groups', function (Blueprint $table) {
            $table->dropColumn('charge');
            $table->dropColumn('rent');
        });
    }
}

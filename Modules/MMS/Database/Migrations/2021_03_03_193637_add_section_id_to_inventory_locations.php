<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSectionIdToInventoryLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('inventory_locations', 'section_id')) {
            Schema::table('inventory_locations', function (Blueprint $table) {
                $table->integer('section_id')->nullable()->after('type');
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
        if (Schema::hasColumn('inventory_locations', 'section_id')) {
            Schema::table('inventory_locations', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }
    }
}

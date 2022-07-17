<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminInInventoryLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('inventory_locations', 'admin')) {
            Schema::table('inventory_locations', function (Blueprint $table) {
                $table->unsignedInteger('admin')->after('department_id')->nullable();
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
        if (Schema::hasColumn('inventory_locations', 'admin')) {
            Schema::table('inventory_locations', function (Blueprint $table) {
                $table->dropColumn('admin');
            });
        }
    }
}

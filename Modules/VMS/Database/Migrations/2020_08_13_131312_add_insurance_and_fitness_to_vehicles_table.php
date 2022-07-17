<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInsuranceAndFitnessToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('vehicles', 'insurance')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->text('insurance')->nullable()->after('purchase_date');
            });
        }
        if (!Schema::hasColumn('vehicles', 'fitness')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->text('fitness')->nullable()->after('purchase_date');
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
        if (Schema::hasColumn('vehicles', 'insurance')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->dropColumn('insurance');
            });
        }
        if (Schema::hasColumn('vehicles', 'fitness')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->dropColumn('fitness');
            });
        }
    }
}

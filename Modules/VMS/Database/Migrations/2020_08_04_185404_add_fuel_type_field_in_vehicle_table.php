<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\VMS\Entities\Vehicle;

class AddFuelTypeFieldInVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fuelTypes = Vehicle::getFuelTypes();
        if (!Schema::hasColumn('vehicles', 'fuel_type')) {
            Schema::table('vehicles', function (Blueprint $table) use ($fuelTypes) {
                $table->string('fuel_type')->default($fuelTypes['gas'])->after('purchase_date');
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
        if (Schema::hasColumn('vehicles', 'fuel_type')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->dropColumn('fuel_type');
            });
        }
    }
}

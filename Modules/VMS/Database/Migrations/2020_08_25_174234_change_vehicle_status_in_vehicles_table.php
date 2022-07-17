<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVehicleStatusInVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('vehicles', 'status')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->string('status')
                    ->default(\Modules\VMS\Entities\Vehicle::getStatuses()['available'])
                    ->change();
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
        if (Schema::hasColumn('vehicles', 'status') && isset(\Modules\VMS\Entities\Vehicle::getStatuses()['active'])) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->string('status')
                    ->default(\Modules\VMS\Entities\Vehicle::getStatuses()['active'])
                    ->change();
            });
        }
    }
}

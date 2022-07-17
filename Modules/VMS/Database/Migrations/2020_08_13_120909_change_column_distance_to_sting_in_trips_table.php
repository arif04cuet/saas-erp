<?php

use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnDistanceToStingInTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $distance = config('vms.trip.distance');
        if (Schema::hasColumn('trips', 'distance')) {
            Schema::table('trips', function (Blueprint $table) use ($distance) {
                $table->text('distance')->default($distance['below_25'])->change();
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
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }

        if (Schema::hasColumn('trips', 'distance')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->double('distance')->default(0.0)->change();
            });
        }
    }
}

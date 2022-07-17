<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeatWiseCalculationRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('room_types', 'seat_wise_calculation')) {
            Schema::table('room_types', function (Blueprint $table) {
                $table->boolean('seat_wise_calculation')
                    ->after('capacity')
                    ->default(false);
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
        if (Schema::hasColumn('room_types', 'seat_wise_calculation')) {
            Schema::table('room_types', function (Blueprint $table) {
                $table->dropColumn('seat_wise_calculation');
            });
        }
    }
}

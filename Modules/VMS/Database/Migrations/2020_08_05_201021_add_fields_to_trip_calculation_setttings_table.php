<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTripCalculationSetttingsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('trip_calculation_settings', function (Blueprint $table) {

            $table->string('title')->nullable(false)->after('id');
            $table->double('per_km_taka')->default(0.0)->after('title');
            $table->double('per_hour_taka')->default(0.0)->after('per_km_taka');
            $table->double('oil_price')->default(0.0)->after('per_hour_taka');
            $table->double('gas_price')->default(0.0)->after('oil_price');
            $table->boolean('is_exceed_setting')->default(false)->after('gas_price');
            $table->string('status')
                ->after('is_exceed_setting')
                ->default(\Modules\VMS\Entities\TripCalculationSetting::getStatus()['inactive']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('trip_calculation_settings', function (Blueprint $table) {
            $columns = [
                'title',
                'per_km_taka',
                'per_hour_taka',
                'oil_price',
                'gas_price',
                'is_exceed_setting',
                'status'
            ];
            // drop all the column from array
            for ($i = 0; $i < count($columns); $i++) {
                if (Schema::hasColumn('trip_calculation_settings', $columns[$i])) {
                    $table->dropColumn($columns[$i]);
                }
            }
        });

    }
}

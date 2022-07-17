<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentPerDayColumnInMasterRollSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_roll_salaries', function (Blueprint $table) {
            $table->double('payment_per_day')->after('number_of_days')->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_roll_salaries', function (Blueprint $table) {
            if (Schema::hasColumn('master_roll_salaries', 'payment_per_day')) {
                $table->dropColumn('payment_per_day');
            }
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBilledToFieldInTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trips', 'billed_to')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->unsignedInteger('billed_to')->nullable()->after('requester_id');
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
        if (Schema::hasColumn('trips', 'billed_to')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropColumn('billed_to');
            });
        }
    }
}

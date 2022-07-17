<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLicenseNumberToDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('drivers', 'license_number')) {
            Schema::table('drivers', function (Blueprint $table) {
                $table->string('license_number')->nullable()->after('address');
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
        if (Schema::hasColumn('drivers', 'license_number')) {
            Schema::table('drivers', function (Blueprint $table) {
                $table->dropColumn('license_number');
            });
        }

    }
}

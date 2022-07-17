<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPastIllnessToPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('prescriptions','past_illness')) {
            Schema::table('prescriptions', function (Blueprint $table) {
                $table->string('past_illness',255)->nullable();
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
        if (Schema::hasColumn('prescriptions','past_illness')) {
            Schema::table('prescriptions', function (Blueprint $table) {
                $table->dropColumn('past_illness');
            });
        }
    }
}

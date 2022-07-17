<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSymptomsToPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('prescriptions','symptoms')) {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->string('symptoms',255)->nullable()->after('employee_id');;
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
        if (Schema::hasColumn('prescriptions','symptoms')) {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropColumn('symptoms');
        });
    }
    }
}

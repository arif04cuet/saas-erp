<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeIdToPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('patients', 'employee_id')) {
        Schema::table('patients', function (Blueprint $table) {
            $table->integer('employee_id')->nullable();
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
        if (Schema::hasColumn('patients', 'employee_id')) {
            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn('employee_id');
            });
        }
    }
}

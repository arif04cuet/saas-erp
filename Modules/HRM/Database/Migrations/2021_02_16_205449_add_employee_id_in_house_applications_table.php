<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeIdInHouseApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('house_applications', 'employee_id')) {
            Schema::table('house_applications', function (Blueprint $table) {
                $table->unsignedInteger('employee_id')->after('house_circular_id')
                    ->nullable();
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
        if (Schema::hasColumn('house_applications', 'employee_id')) {
            Schema::table('house_applications', function (Blueprint $table) {
                $table->dropColumn('employee_id');
            });
        }
    }
}

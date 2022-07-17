<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHouseEligibilityInEmployeesTable extends Migration
{
    private $columnName = 'house_eligibility_date';
    private $tableName = 'employee_personal_info';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn($this->columnName, $this->tableName)) {
            Schema::table($this->tableName, function (Blueprint $table) {
                $table->date($this->columnName)->after('job_joining_date')->nullable();
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
        if (Schema::hasColumn($this->columnName, $this->tableName)) {
            Schema::table($this->tableName, function (Blueprint $table) {
                $table->dropColumn($this->columnName);
            });
        }
    }
}

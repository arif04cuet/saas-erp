<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddColumnIsDeadDateOfDeathInEmployeePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_personal_info', function (Blueprint $table) {
            $table->boolean('is_dead')->default(false);
            $table->date('date_of_death')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_personal_info', function (Blueprint $table) {

            if(Schema::hasColumn('employee_personal_info', 'is_dead')) {
                $table->dropColumn('is_dead');
            }

            if(Schema::hasColumn('employee_personal_info', 'date_of_death')) {
                $table->dropColumn('date_of_death');
            }
        });
    }
}

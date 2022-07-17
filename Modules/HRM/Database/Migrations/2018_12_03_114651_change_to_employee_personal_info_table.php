<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToEmployeePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('employee_personal_info', function (Blueprint $table) {
		    $table->string( 'salary_scale' )->change();

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
		    $table->integer( 'salary_scale' )->change();

	    });
    }
}

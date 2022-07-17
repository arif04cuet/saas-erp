<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEmployeePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_personal_info', function (Blueprint $table){
            $table->string('husband_name')->nullable();
            $table->string('nid_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('employee_personal_info','nid_number')){
            Schema::table('employee_personal_info', function (Blueprint $table){
                $table->dropColumn('nid_number');
                $table->dropColumn('husband_name');
            });
        }
    }
}

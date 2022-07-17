<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditAcademicInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('academic_institutes', 'type'))
        {
            Schema::table('academic_institutes', function (Blueprint $table){
                $table->string('type', '20')->default('university');
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
        if(Schema::hasColumn('academic_institutes', 'type'))
        {
            Schema::table('academic_institutes', function (Blueprint $table){
                $table->dropColumn('type');
            });
        }
    }
}

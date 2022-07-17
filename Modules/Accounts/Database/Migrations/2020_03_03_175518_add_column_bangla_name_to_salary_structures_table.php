<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBanglaNameToSalaryStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salary_structures', function (Blueprint $table) {
            $table->string('bangla_name')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_structures', function (Blueprint $table) {
            $columns = ['bangla_name'];
            //drop all the column from array
            for ($i = 0; $i < count($columns); $i++) {
                if (Schema::hasColumn('salary_structures', $columns[$i])) {
                    $table->dropColumn($columns[$i]);
                }
            }
        });
    }
}

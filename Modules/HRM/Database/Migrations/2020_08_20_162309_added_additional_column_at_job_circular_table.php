<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedAdditionalColumnAtJobCircularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_circulars', function (Blueprint $table) {
            $table->unsignedInteger('designation_id');
            $table->integer('salary_grade');
            $table->string('reference_number');
            $table->dropColumn('salary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->myDropColumnIfExists('job_circulars', 'designation_id');
        $this->myDropColumnIfExists('job_circulars', 'salary_grade');
        $this->myDropColumnIfExists('job_circulars', 'reference_number');
    }

    function myDropColumnIfExists($myTable, $column)
    {
        if (Schema::hasColumn($myTable, $column)) //check the column
        {
            Schema::table($myTable, function (Blueprint $table) use ($column) {
                $table->dropColumn($column); //drop it
            });
        }
    }
}

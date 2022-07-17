<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionColumnAtEmployeeTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_trainings', function (Blueprint $table) {
            $table->string('result')->nullable()->change();
            $table->string('category');
            $table->string('region');
            $table->string('nominating_authority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_trainings', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('region');
            $table->dropColumn('nominating_authority');
        });
    }
}

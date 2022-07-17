<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDateColumnsOnTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings', function (Blueprint $table) {
            DB::statement("ALTER TABLE trainings MODIFY start_date date NULL");
            DB::statement("ALTER TABLE trainings MODIFY end_date date NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings', function (Blueprint $table) {
            DB::statement("ALTER TABLE trainings MODIFY start_date date NULL");
            DB::statement("ALTER TABLE trainings MODIFY end_date date NULL");
        });
    }
}

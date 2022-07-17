<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSalaryColumnJobCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_circulars', function (Blueprint $table) {
            DB::statement('ALTER TABLE job_circulars MODIFY salary varchar(150) NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_circulars', function (Blueprint $table) {
            if (Schema::hasColumn('job_circulars', 'salary')) {
                DB::statement('ALTER TABLE job_circulars MODIFY salary varchar(150) NULL');
            }
        });
    }
}

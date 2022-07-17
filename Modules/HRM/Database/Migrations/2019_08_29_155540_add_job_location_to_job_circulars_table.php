<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobLocationToJobCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_circulars', function (Blueprint $table) {
            if (!Schema::hasColumn('job_circulars', 'job_location')) {
                $table->string('job_location', 191);
            }
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
            if (Schema::hasColumn('job_circulars', 'job_location')) {
                $table->dropColumn('job_location');
            }
        });
    }
}

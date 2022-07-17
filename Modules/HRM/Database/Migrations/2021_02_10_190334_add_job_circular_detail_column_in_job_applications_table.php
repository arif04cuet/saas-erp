<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobCircularDetailColumnInJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('job_applications', 'job_circular_detail_id')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->unsignedInteger('job_circular_detail_id')
                    ->nullable()
                    ->after('circular_no');
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
        if (Schema::hasColumn('job_applications', 'job_circular_detail_id')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->dropColumn('job_circular_detail_id');
            });
        }
    }
}

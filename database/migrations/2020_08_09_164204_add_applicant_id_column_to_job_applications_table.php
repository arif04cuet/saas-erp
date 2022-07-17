<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplicantIdColumnToJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('job_applications', 'applicant_id')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->string('applicant_id', 20)->after('id');
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
        if (!Schema::hasColumn('job_applications', 'applicant_id')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->dropColumn('applicant_id');
            });
        }
    }
}

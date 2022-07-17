<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPostNameColumnAtJobApplicantExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_applicant_experiences', function(Blueprint $table) {
            $table->date('to')->nullable()->change();
            if (Schema::hasColumn('job_applicant_experiences', 'post_name')) {
                $table->dropColumn('post_name');
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
        //
    }
}

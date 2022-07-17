<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSystemShortlistToJobCircularsTableAndUpdateJobCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_circulars', function (Blueprint $table) {
            if(!Schema::hasColumn('job_circulars', 'system_shortlist')) {
                $table->tinyInteger('system_shortlist')->default(0);
            }

            $columnsToBeDeleted = array();
            if (Schema::hasColumn('job_circulars', 'min_ssc_year')) {
                array_push($columnsToBeDeleted, 'min_ssc_year');
            }
            if (Schema::hasColumn('job_circulars', 'min_hsc_year')) {
                array_push($columnsToBeDeleted, 'min_hsc_year');
            }
            if (Schema::hasColumn('job_circulars', 'min_grad_year')) {
                array_push($columnsToBeDeleted, 'min_grad_year');
            }
            if (Schema::hasColumn('job_circulars', 'min_post_grad_year')) {
                array_push($columnsToBeDeleted, 'min_post_grad_year');
            }
            if (Schema::hasColumn('job_circulars', 'ssc_point')) {
                array_push($columnsToBeDeleted, 'ssc_point');
            }
            if (Schema::hasColumn('job_circulars', 'hsc_point')) {
                array_push($columnsToBeDeleted, 'hsc_point');
            }
            if (Schema::hasColumn('job_circulars', 'grad_point')) {
                array_push($columnsToBeDeleted, 'grad_point');
            }
            if (Schema::hasColumn('job_circulars', 'post_grad_point')) {
                array_push($columnsToBeDeleted, 'post_grad_point');
            }

            $table->dropColumn($columnsToBeDeleted);
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
            if(Schema::hasColumn('job_circulars', 'system_shortlist')) {
                $table->dropColumn('system_shortlist');
            }

            if (!Schema::hasColumn('job_circulars', 'min_ssc_year')) {
                $table->date('min_ssc_year')->nullable();
            }
            if (!Schema::hasColumn('job_circulars', 'min_hsc_year')) {
                $table->date('min_hsc_year')->nullable();
            }
            if (!Schema::hasColumn('job_circulars', 'min_grad_year')) {
                $table->date('min_grad_year')->nullable();
            }
            if (!Schema::hasColumn('job_circulars', 'min_post_grad_year')) {
                $table->date('min_post_grad_year')->nullable();
            }
            if (!Schema::hasColumn('job_circulars', 'ssc_point')) {
                $table->double('ssc_point');
            }
            if (!Schema::hasColumn('job_circulars', 'hsc_point')) {
                $table->double('hsc_point');
            }
            if (!Schema::hasColumn('job_circulars', 'grad_point')) {
                $table->double('grad_point');
            }
            if (!Schema::hasColumn('job_circulars', 'post_grad_point')) {
                $table->double('post_grad_point')->nullable();
            }
        });
    }
}

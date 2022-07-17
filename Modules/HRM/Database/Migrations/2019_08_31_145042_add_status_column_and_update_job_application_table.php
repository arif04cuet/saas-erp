<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnAndUpdateJobApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if(!Schema::hasColumn('job_applications', 'status')) {
                $table->enum('status', [
                        'submitted',
                        'reviewed',
                        'qualified',
                        'disqualified',
                        'short_listed',
                        'recruited'
                    ])->default('submitted');
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
        Schema::table('job_applications', function (Blueprint $table) {
            if(Schema::hasColumn('job_applications', 'status')) {
                $table->dropColumn(['status']);
            }
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnAndUpdateAppraisalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appraisals', function (Blueprint $table) {

            $table->dropColumn(['rank_id', 'employee_id']);

            $table->enum('status', ['new', 'initialized', 'reported', 'verified', 'signed', 'completed'])->default('new');
            $table->enum('type', ['first', 'second', 'third', 'fourth']);
            $table->unsignedInteger('reporting_employee_id')->nullable();
            $table->unsignedInteger('reporter_id')->nullable();
            $table->unsignedInteger('signer_id')->nullable();
            $table->unsignedInteger('medical_reporter_id')->nullable();
            $table->unsignedInteger('initiator_id')->nullable();
            $table->unsignedInteger('finisher_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appraisals', function (Blueprint $table) {

            $table->dropColumn([
                'status',
                'type',
                'reporting_employee_id',
                'reporter_id',
                'signer_id',
                'medical_reporter_id',
                'initiator_id',
                'finisher_id'
            ]);

            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('rank_id')->after('employee_id');


        });
    }
}

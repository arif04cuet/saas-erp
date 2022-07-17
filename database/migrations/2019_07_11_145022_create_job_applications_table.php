<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('circular_no');
            $table->string('applicant_name');
            $table->string('applicant_name_bn');
            $table->string('national_id')->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('father_name');
            $table->string('mother_name');
            $table->integer('present_address');
            $table->integer('permanent_address');
            $table->string('mobile');
            $table->string('email');
            $table->string('nationality');
            $table->string('gender');
            $table->string('religion');
            $table->string('occupation')->nullable();
            $table->text('extra_qualities')->nullable();
            $table->string('quota')->nullable();
            $table->string('bank_draft_no');
            $table->date('payment_date');
            $table->string('name_of_bank_branch');
            $table->tinyInteger('is_divisional_applicant');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}

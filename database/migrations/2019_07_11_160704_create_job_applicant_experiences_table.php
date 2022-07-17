<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicantExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicant_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_application_id');
            $table->string('designation');
            $table->string('post_name');
            $table->string('organization_name');
            $table->string('length_of_service');
            $table->date('from');
            $table->date('to');
            $table->text('responsibilities');

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
        Schema::dropIfExists('job_applicant_experiences');
    }
}

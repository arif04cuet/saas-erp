<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicantResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicant_researches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_application_id');
            $table->string('title');
            $table->string('duration');
            $table->date('from');
            $table->date('to');
            $table->string('supervisor');
            $table->string('organaization');
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
        Schema::dropIfExists('job_applicant_researches');
    }
}

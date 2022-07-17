<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicantAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicant_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('care_of');
            $table->string('road_and_house');
            $table->string('district');
            $table->string('sub_district');
            $table->string('union')->nullable();
            $table->string('post_office');
            $table->string('post_code');

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
        Schema::dropIfExists('job_applicant_addresses');
    }
}

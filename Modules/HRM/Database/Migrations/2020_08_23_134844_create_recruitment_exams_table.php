<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_circular_id');
            $table->integer('preliminary_total')->nullable();
            $table->integer('preliminary_pass')->nullable();
            $table->integer('written_total')->nullable();
            $table->integer('written_pass')->nullable();
            $table->integer('aptitude_total')->nullable();
            $table->integer('aptitude_pass')->nullable();
            $table->integer('viva_total')->nullable();
            $table->integer('viva_pass')->nullable();
            $table->string('status')->default('active');

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
        Schema::dropIfExists('recruitment_exams');
    }
}

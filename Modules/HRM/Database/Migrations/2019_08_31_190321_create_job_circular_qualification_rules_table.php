<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobCircularQualificationRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_circular_qualification_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_circular_id');
            $table->date('min_ssc_year')->nullable();
            $table->date('min_hsc_year')->nullable();
            $table->date('min_grad_year')->nullable();
            $table->date('min_post_grad_year')->nullable();
            $table->double('ssc_point')->nullable();
            $table->double('hsc_point')->nullable();
            $table->double('grad_point')->nullable();
            $table->double('post_grad_point')->nullable();
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->integer('upper_age_limit')->nullable();
            $table->integer('lower_age_limit')->nullable();
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
        Schema::dropIfExists('job_circular_qualification_rules');
    }
}

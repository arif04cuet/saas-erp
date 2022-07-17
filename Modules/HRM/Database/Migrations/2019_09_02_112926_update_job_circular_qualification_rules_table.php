<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateJobCircularQualificationRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('job_circular_qualification_rules');

        Schema::create('job_circular_qualification_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_circular_id');
            $table->year('min_ssc_year')->nullable();
            $table->year('min_hsc_year')->nullable();
            $table->year('min_grad_year')->nullable();
            $table->year('min_post_grad_year')->nullable();
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
        Schema::table('', function (Blueprint $table) {
            Schema::dropIfExists('job_circular_qualification_rules');
        });
    }
}

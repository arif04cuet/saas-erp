<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_trainings', function (Blueprint $table) {
            $table->increments('id');
	        $table->unsignedInteger('employee_id');
            $table->string('course_name');
            $table->string('organization_name');
            $table->string('duration')->nullable();
            $table->string('training_year')->nullable();
            $table->string('organization_country')->nullable();
            $table->string('result');
            $table->string('achievement')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_trainings');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredTraineePhysicalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_trainee_physicalInfos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trainee_id');
            $table->integer('joining_age');
            $table->double('hieght');
            $table->double('weight');
            $table->double('normal_chest');
            $table->double('expended_chest');
            $table->double('weight_end_course');
            $table->string('expertise_sports')->nullable();
            $table->string('hobby')->nullable();
            $table->string('experience')->nullable();
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
        Schema::dropIfExists('registered_trainee_physicalInfos');
    }
}

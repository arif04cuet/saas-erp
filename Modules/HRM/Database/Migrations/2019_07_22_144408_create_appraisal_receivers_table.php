<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_receivers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appraisal_id');
            $table->unsignedInteger('receiver_id');
            $table->tinyInteger('is_initiator')->default(1);
            $table->string('signature');
            $table->string('seal');
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
        Schema::dropIfExists('appraisal_receivers');
    }
}

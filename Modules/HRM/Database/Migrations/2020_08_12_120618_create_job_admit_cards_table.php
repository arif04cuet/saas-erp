<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobAdmitCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_admit_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_circular_id');
            $table->string('exam_type', 20);
            $table->dateTime('date_of_exam');
            $table->string('exam_center');
            $table->string('location');

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
        Schema::dropIfExists('job_admit_cards');
    }
}

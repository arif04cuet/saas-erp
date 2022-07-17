<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_circulars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->string('vacancy_no', 50);
            $table->enum('job_nature', ['full-time', 'part-time', 'contractual', 'outsourcing'])->default('full-time');
            $table->string('salary', 150);
            $table->dateTime('application_deadline');
            $table->text('educational_requirement');
            $table->text('experience_requirement');
            $table->text('job_responsibility')->nullable();
            $table->text('other_requirements')->nullable();
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
        Schema::dropIfExists('job_circulars');
    }
}

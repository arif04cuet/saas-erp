<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_basics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payscale_id');
            $table->tinyInteger('grade');
            $table->float('basic_salary');
            $table->float('percentage_of_increment');
            $table->tinyInteger('no_of_increment');

            $table->softDeletes();
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
        Schema::dropIfExists('salary_basics');
    }
}

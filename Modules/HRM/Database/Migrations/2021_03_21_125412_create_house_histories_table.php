<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_details_id')->unsigned();
            $table->integer('employee_id')->nullable();
            $table->dateTime('from_date');
            $table->dateTime('to_date')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('house_histories');
    }
}

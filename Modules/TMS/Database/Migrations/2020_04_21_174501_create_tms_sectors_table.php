<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('title_english');
            $table->string('title_bangla');
            $table->tinyInteger('sequence')->nullable();
            $table->string('details')->nullable();

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
        Schema::dropIfExists('tms_sectors');
    }
}

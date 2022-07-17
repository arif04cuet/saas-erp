<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsSubSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_sub_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tms_sector_id');
            $table->string('code')->unique();
            $table->string('title_english');
            $table->string('title_bangla');
            $table->integer('sequence')->nullable();
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
        Schema::dropIfExists('tms_sub_sectors');
    }
}

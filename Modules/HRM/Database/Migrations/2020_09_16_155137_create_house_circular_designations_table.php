<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseCircularDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_circular_designations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_circular_id');
            $table->unsignedInteger('house_circular_category_id');
            $table->unsignedInteger('designation_id');
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
        Schema::dropIfExists('house_circular_designations');
    }
}

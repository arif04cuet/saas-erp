<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue_selections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cafeteria_venue_id');
            $table->unsignedInteger('training_id');
            $table->date('selection_date');
            $table->string('food_type');
            $table->integer('total_trainee');
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('venue_selections');
    }
}

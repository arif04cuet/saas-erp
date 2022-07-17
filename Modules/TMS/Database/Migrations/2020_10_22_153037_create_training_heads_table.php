<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('training_heads')) {

            Schema::create('training_heads', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title_english')->nullable(false);
                $table->string('title_bangla')->nullable(false);
                $table->string('level')->default(\Modules\TMS\Entities\TrainingHead::getLevels()['national']);
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_heads');
    }
}

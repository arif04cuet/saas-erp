<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('monthly_updatable_id');
            $table->string('monthly_updatable_type');
            $table->date('date');
            $table->text('achievement')->nullable();
            $table->text('planning');
            $table->string('tasks')->nullable();
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
        Schema::dropIfExists('monthly_updates');
    }
}

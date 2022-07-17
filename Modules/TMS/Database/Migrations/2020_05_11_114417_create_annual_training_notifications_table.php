<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualTrainingNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_training_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('attachment')->nullable();
            $table->string('attachment_file_name')->nullable();
            $table->text('note');
            $table->boolean('send_to_divisional_director')->default(false);

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
        Schema::dropIfExists('annual_training_notifications');
    }
}

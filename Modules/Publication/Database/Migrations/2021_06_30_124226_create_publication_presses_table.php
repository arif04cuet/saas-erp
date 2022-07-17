<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationPressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_presses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('press_name_en');
            $table->string('press_name_bn');
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('status');

            $table->unsignedInteger('press_user_id');
            $table->foreign('press_user_id')->references('id')->on('employees')->onDelete('cascade');

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
        Schema::dropIfExists('publication_presses');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEconomyCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economy_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 20);
            $table->string('english_name', 200);
            $table->string('bangla_name', 200);
            $table->text('description')->nullable();
            $table->unsignedInteger('economy_head_id');
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
        Schema::dropIfExists('economy_codes');
    }
}

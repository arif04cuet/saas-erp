<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliver_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('deliver_date');
            $table->string('department');
            $table->string('status');
            $table->unsignedInteger('user_id');
            $table->text('remark')->nullable();
            $table->text('approval_note')->nullable();
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
        Schema::dropIfExists('deliver_materials');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_circulars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no');
            $table->date('apply_from');
            $table->date('apply_to');
            $table->enum('status', ['draft', 'active', 'inactive', 'completed']);
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('house_circulars');
    }
}

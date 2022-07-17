<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_id')->nullable(false);
            $table->date('date')->nullable(false);
            $table->tinyInteger('status')->default('1');
            $table->string('acknowledgement_slip')->nullable();
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
        Schema::dropIfExists('medicine_distributions');
    }
}

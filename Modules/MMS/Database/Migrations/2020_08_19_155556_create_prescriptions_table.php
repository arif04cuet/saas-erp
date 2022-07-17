<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('patient_id')->nullable(false);
            $table->date('date')->nullable(false);
            $table->string('name');
            $table->integer('age');
            $table->text('mobile_no');
            $table->string('gender');
            $table->string('relation')->nullable();
            $table->string('type');
            $table->integer('employee_id')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}

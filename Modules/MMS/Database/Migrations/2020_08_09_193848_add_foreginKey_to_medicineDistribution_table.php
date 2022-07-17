<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginKeyToMedicineDistributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_distributions', function (Blueprint $table) {
            $table->foreign('patient_id','fk_medicine_patient_id')->references('patient_id')->on('patients')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_distributions', function (Blueprint $table) {
            $table->dropForeign('fk_medicine_patient_id');
        });
    }
}

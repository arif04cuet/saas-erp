<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMedicineNameToPrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('prescription_medicines','medicine_name')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->string('medicine_name',255)->nullable();
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

        if (Schema::hasColumn('prescription_medicines','medicine_name')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->dropColumn('medicine_name');
            });
        }
    }
}

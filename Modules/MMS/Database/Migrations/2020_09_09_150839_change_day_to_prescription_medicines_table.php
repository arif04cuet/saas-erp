<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDayToPrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('prescription_medicines','day')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->renameColumn('day', 'type')->default('0');
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
        if (Schema::hasColumn('prescription_medicines','type')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->dropColumn('type');

            });
        }
    }
}

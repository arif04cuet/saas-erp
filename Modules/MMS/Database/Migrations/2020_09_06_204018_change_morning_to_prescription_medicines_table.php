<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMorningToPrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('prescription_medicines','morning')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->renameColumn('morning', 'dose');
            });
        }

        if (Schema::hasColumn('prescription_medicines','noon')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->renameColumn('noon', 'in_stock')->nullable(false)->default('0')->change();
            });
        }

        if (Schema::hasColumn('prescription_medicines','night')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->renameColumn('night', 'total_medicine')->nullable(false)->default('0')->change();
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
        if (Schema::hasColumn('prescription_medicines','dose')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->dropColumn('dose');
                $table->dropColumn('in_stock');
                $table->dropColumn('total_medicine');

            });
        }

    }
}

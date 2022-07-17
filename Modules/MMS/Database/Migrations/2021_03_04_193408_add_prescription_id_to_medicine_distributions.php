<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrescriptionIdToMedicineDistributions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('medicine_distributions', 'prescription_id')) {
            Schema::table('medicine_distributions', function (Blueprint $table) {
                $table->integer('prescription_id')->nullable(false)->default(0)->after('patient_id');
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
        if (Schema::hasColumn('medicine_distributions', 'prescription_id')) {
            Schema::table('medicine_distributions', function (Blueprint $table) {
                $table->dropColumn('prescription_id');
            });
        }
    }
}

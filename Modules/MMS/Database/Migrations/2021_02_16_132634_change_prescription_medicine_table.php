<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePrescriptionMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('prescription_medicines','dose')) {
            Schema::table('prescription_medicines', function (Blueprint $table) {
                $table->string('dose')->change();
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
            });
        }
    }
}

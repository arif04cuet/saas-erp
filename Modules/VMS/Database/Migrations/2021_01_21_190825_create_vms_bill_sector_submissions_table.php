<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVmsBillSectorSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable   ('vms_bill_sector_submissions')) {
            Schema::create('vms_bill_sector_submissions', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('vms_bill_sector_id');
                $table->unsignedInteger('employee_id');
                $table->double('amount')->default(0.0);
                $table->date('date');
                $table->timestamps();
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
        Schema::dropIfExists('vms_bill_sector_submissions');
    }
}

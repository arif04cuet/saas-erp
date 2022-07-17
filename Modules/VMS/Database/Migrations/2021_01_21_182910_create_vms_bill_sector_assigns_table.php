<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVmsBillSectorAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vms_bill_sector_assigns')) {
            Schema::create('vms_bill_sector_assigns', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('employee_id');
                $table->unsignedInteger('vms_bill_sector_id');
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
        Schema::dropIfExists('vms_bill_sector_assigns');
    }
}

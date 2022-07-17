<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVmsBillSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vms_bill_sectors')) {
            Schema::create('vms_bill_sectors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title_english')->nullable();
                $table->string('title_bangla')->nullable();
                $table->double('amount')->default(0.0);
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
        Schema::dropIfExists('vms_bill_sectors');
    }
}

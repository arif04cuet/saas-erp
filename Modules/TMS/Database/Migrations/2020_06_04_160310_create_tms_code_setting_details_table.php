<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsCodeSettingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_code_setting_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tms_code_setting_id')->nullable(false);
            $table->unsignedInteger('tms_sub_sector_id');
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
        Schema::dropIfExists('tms_code_setting_details');
    }
}

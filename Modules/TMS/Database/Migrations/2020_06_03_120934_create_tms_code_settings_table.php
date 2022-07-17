<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsCodeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statusActive = strtolower(\Modules\TMS\Entities\TmsCodeSetting::getStatuses()['active']);
        Schema::create('tms_code_settings', function (Blueprint $table) use ($statusActive) {
            $table->increments('id');
            $table->unsignedInteger('economy_code')->nullable(false);
            $table->unsignedInteger('journal_id')->nullable(false);
            $table->string('status')->default($statusActive);
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
        Schema::dropIfExists('tms_code_settings');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmCodeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statusActive = strtolower(\Modules\HM\Entities\HmCodeSetting::getStatuses()['active']);
        Schema::create('hm_code_settings', function (Blueprint $table) use ($statusActive) {
            $table->increments('id');
            $table->unsignedInteger('economy_code')->nullable(false);
            $table->unsignedInteger('journal_id')->nullable();
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
        Schema::dropIfExists('hm_code_settings');
    }
}

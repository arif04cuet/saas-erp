<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVmsIntegrationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vms_integration_settings')) {
            return;
        }
        Schema::create('vms_integration_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('salary_rule_id');
            $table->unsignedInteger('tms_sub_sector_id');
            $table->unsignedInteger('fuel_bill_economy_code');
            $table->unsignedInteger('vehicle_maintenance_economy_code');
            $table->unsignedInteger('project_economy_code');
            $table->unsignedInteger('accounts_bank_cash_economy_code');
            $table->unsignedInteger('tms_bank_cash_economy_code');
            $table->unsignedInteger('pms_bank_cash_economy_code');
            $table->string('status')->default('active');
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
        Schema::dropIfExists('vms_integration_settings');
    }
}

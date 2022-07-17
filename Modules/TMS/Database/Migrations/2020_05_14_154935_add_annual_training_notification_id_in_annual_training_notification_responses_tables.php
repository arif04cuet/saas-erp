<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnnualTrainingNotificationIdInAnnualTrainingNotificationResponsesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annual_training_notification_responses', function (Blueprint $table) {
            $table->unsignedInteger('annual_training_notification_id')
                ->nullable(false)
                ->after('annual_training_notification_organization_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('annual_training_notification_responses', 'annual_training_notification_id')) {
            Schema::table('annual_training_notification_responses', function (Blueprint $table) {
                $table->dropColumn('annual_training_notification_id');
            });
        }
    }
}

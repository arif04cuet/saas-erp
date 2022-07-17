<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualTrainingNotificationOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_training_notification_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('annual_training_notification_id');
            $table->integer('training_organization_id');
            $table->string('unique_key');
            $table->dateTime('date_of_response')->nullable();
            $table->date('last_date_of_response');
            $table->string('status', 20)->default('pending');

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
        Schema::dropIfExists('annual_training_notification_organizations');
    }
}

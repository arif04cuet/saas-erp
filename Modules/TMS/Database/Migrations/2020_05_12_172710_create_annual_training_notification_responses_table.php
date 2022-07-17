<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualTrainingNotificationResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $responseTypes = array_keys(\Modules\TMS\Entities\AnnualTrainingNotificationResponse::getResponseTypes());
        Schema::create('annual_training_notification_responses', function (Blueprint $table) use ($responseTypes) {
            $table->increments('id');
            $table->unsignedInteger('annual_training_notification_organization_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('type')->default($responseTypes[0]);
            $table->text('title')->nullable(false);
            $table->integer('no_of_trainee')->nullable(false);
            $table->string('participant_type')->nullable(false);
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->text('remark')->nullable(true);
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
        Schema::dropIfExists('annual_training_notification_responses');
    }
}

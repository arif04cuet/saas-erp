<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowRuleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_rule_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rule_master_id');
            $table->integer('designation_id')->nullable();
            $table->smallInteger('notification_order')->default(1);
            $table->smallInteger('number_of_responder')->default(1);
            $table->boolean('is_group_notification')->default(true);

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
        Schema::dropIfExists('workflow_rule_details');
    }
}

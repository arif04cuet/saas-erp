<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workflow_master_id');
            $table->integer('rule_detail_id');
            $table->integer('designation_id');
            $table->integer('notification_order');
            $table->boolean('is_group_notification')->default(true);
            $table->integer('creator_id');
            $table->integer('responder_id')->nullable();
            $table->string('responder_remarks')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('workflow_details');
    }
}

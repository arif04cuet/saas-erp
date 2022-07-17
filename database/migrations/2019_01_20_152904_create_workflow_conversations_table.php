<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workflow_master_id');
            $table->integer('workflow_details_id');
            $table->integer('feature_id');
            $table->string('message')->nullable();
            $table->enum('status', ['ACTIVE', 'CLOSED']);
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
        Schema::dropIfExists('workflow_conversations');
    }
}

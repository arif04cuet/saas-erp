<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_id');
            $table->integer('rule_master_id');
            $table->integer('ref_table_id');
            $table->enum('status', ['INITIATED', 'PENDING', 'APPROVED', 'REJECTED', 'CLOSED', 'REINITIATED']);
            $table->integer('initiator_id');
            $table->integer('reinitiate_ref_id')->nullable();

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
        Schema::dropIfExists('workflow_masters');
    }
}

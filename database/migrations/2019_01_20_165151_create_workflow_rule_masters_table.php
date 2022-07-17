<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowRuleMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_rule_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_id');
            $table->integer('department_id');
            $table->string('name');
            $table->text('rule');
            $table->enum('get_back_status', ['none', 'initial', 'previous']);
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
        Schema::dropIfExists('workflow_rule_masters');
    }
}

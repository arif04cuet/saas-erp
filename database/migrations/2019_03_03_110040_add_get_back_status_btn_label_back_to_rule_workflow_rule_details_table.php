<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGetBackStatusBtnLabelBackToRuleWorkflowRuleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workflow_rule_details', function (Blueprint $table) {
            $table->string('get_back_status')->default('PREVIOUS');//INITIAL, PREVIOUS, NONE, SELECTION,
            $table->string('back_to_rule')->nullable();
            $table->string('proceed_to_status')->default('NEXT'); //NEXT, SELECTION
            $table->string('proceed_to_rule')->nullable();
            $table->string('flow_type')->default('APPROVAL'); //APPROVAL and REVIEW
            $table->boolean('is_optional')->default(false);
            $table->boolean('is_shareable')->default(false);
            $table->smallInteger('share_rule_id')->nullable();
            $table->string('back_btn_label')->default('Send Back');
            $table->string('proceed_btn_label')->default('Approve');
            $table->string('reject_btn_label')->default('Reject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workflow_rule_details', function (Blueprint $table) {
            //
        });
    }
}

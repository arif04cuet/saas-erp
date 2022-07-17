<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCanApproveToWorkflowRuleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workflow_rule_details', function (Blueprint $table) {
            $table->boolean('can_approve')->default(false)->after('share_rule_id');
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
            $table->dropColumn('can_approve');
        });
    }
}

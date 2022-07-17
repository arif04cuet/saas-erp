<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateShareRuleDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('share_rules_designations', function (Blueprint $table) {
            $table->boolean('is_sharable')->default(false);
            $table->integer('sharable_id')->default(false)->comment('Share rules id');
            $table->boolean('can_reject')->default(true);
            $table->boolean('can_approve')->default(false);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

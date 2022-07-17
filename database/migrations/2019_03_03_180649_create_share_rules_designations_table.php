<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareRulesDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_rules_designations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('share_rule_id');
            $table->integer('department_id');
            $table->string('department')->nullable();
            $table->integer('designation_id');
            $table->string('designation')->nullable();
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
        Schema::dropIfExists('share_rules_designations');
    }
}

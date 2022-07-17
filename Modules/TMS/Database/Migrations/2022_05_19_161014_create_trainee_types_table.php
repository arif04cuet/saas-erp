<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_types', function (Blueprint $table) {
            $table->id();
            $table->string('trainee_type');
            $table->bigInteger('trainee_id');
            $table->string('org_name')->nullable();
            $table->string('org_id')->nullable();
            $table->string('org_member_name')->nullable();
            $table->string('org_member_join_date')->nullable();
            $table->string('doptor_name')->nullable();
            $table->string('doptor_service_id')->nullable();
            $table->string('doptor_present_designation')->nullable();
            $table->string('doptor_join_date')->nullable();
            $table->string('doptor_present_designation_join_date')->nullable();
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
        Schema::dropIfExists('trainee_types');
    }
};

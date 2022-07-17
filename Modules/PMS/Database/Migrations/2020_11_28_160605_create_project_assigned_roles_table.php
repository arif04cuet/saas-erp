<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAssignedRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('project_assigned_roles')) {
            Schema::create('project_assigned_roles', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('project_id');
                $table->unsignedInteger('project_director_id')->nullable();
                $table->unsignedInteger('project_sub_director_id')->nullable();
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_assigned_roles');
    }
}

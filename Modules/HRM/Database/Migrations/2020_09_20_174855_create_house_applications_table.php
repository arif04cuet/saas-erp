<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_circular_id');
            $table->string('name');
            $table->string('designation');
            $table->string('department');
            $table->integer('salary_grade');
            $table->text('salary_scale');
            $table->integer('salary');
            $table->text('birth_date');
            $table->text('bard_joining_date');
            $table->text('current_position_date')->nullable();
            $table->text('present_address');
            $table->string('house_no')->nullable();
            $table->text('dp_head_recommandation')->nullable();
            $table->enum('status', ['submitted', 'selected', 'rejected'])->default('submitted');
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
        Schema::dropIfExists('house_applications');
    }
}

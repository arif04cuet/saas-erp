<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTraineeIdFieldToNullableInFieldInCheckinTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkin_trainees', function (Blueprint $table) {
            if (Schema::hasColumn('checkin_trainees', 'trainee_id')) {
                $table->unsignedInteger('trainee_id')->nullable()->change();
            }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkin_trainees', function (Blueprint $table) {
            if (Schema::hasColumn('checkin_trainees', 'trainee_id')) {
                $table->unsignedInteger('trainee_id')->nullable(false)->change();
            }
        });

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingCafeteriaIdToTrainingCourseBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_breaks', function (Blueprint $table) {
            if (!Schema::hasColumn('training_course_breaks', 'training_cafeteria_id')) {
                $table->unsignedInteger('training_cafeteria_id');
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
        Schema::table('training_course_breaks', function (Blueprint $table) {
            if (Schema::hasColumn('training_course_breaks', 'training_cafeteria_id')) {
                $table->dropColumn('training_cafeteria_id');
            }
        });
    }
}

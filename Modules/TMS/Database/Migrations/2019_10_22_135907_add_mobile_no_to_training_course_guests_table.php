<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileNoToTrainingCourseGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_guests', function (Blueprint $table) {
            if (!Schema::hasColumn('training_course_guests', 'mobile_no')) {
                $table->string('mobile_no');
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
        Schema::table('training_course_guests', function (Blueprint $table) {
            if (Schema::hasColumn('training_course_guests', 'mobile_no')) {
                $table->dropColumn('mobile_no');
            }
        });
    }
}

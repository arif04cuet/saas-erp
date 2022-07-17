<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMarkToTableTrainingCourseModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_modules', function (Blueprint $table) {
            $table->double('mark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_course_modules', function (Blueprint $table) {
            if(Schema::hasColumn('training_course_modules', 'mark')) {
                $table->dropColumn('mark');
            }
        });
    }
}

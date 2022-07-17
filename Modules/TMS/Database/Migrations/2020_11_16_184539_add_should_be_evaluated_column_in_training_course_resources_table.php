<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShouldBeEvaluatedColumnInTrainingCourseResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('training_course_resources', 'should_be_evaluated')) {
            Schema::table('training_course_resources', function (Blueprint $table) {
                $table->boolean('should_be_evaluated')
                    ->after('short_name')
                    ->default(true);
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
        if (Schema::hasColumn('training_course_resources', 'should_be_evaluated')) {
            Schema::table('training_course_resources', function (Blueprint $table) {
                $table->dropColumn('should_be_evaluated');
            });
        }
    }
}

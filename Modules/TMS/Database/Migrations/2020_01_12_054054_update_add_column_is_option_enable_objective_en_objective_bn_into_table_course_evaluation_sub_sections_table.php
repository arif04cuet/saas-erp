<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddColumnIsOptionEnableObjectiveEnObjectiveBnIntoTableCourseEvaluationSubSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_evaluation_sub_sections', function (Blueprint $table) {
            if (Schema::hasColumn('course_evaluation_sub_sections', 'is_option_enable')) {
                $table->boolean('is_option_enable')->default(0)->change();
                $table->renameColumn('is_option_enable', 'is_option_enabled');
            }

            $table->text('objective_en')->nullable();
            $table->text('objective_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_evaluation_sub_sections', function (Blueprint $table) {
            if (Schema::hasColumn('course_evaluation_sub_sections', 'is_option_enabled')) {
                $table->boolean('is_option_enabled')->nullable(false)->change();
                $table->renameColumn('is_option_enabled', 'is_option_enable');
            }

            if (Schema::hasColumn('course_evaluation_sub_sections', 'objective_en')) {
                $table->dropColumn('objective_en');
            }

            if (Schema::hasColumn('course_evaluation_sub_sections', 'objective_bn')) {
                $table->dropColumn('objective_bn');
            }
        });
    }
}

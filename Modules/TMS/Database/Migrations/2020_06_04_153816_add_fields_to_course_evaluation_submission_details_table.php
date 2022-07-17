<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCourseEvaluationSubmissionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_evaluation_submission_details', function (Blueprint $table) {
            $table->string('question_type')->after('course_evaluation_submission_id')->nullable();
            $table->unsignedInteger('course_evaluation_sub_section_id')->after('question_type')->nullable();
            $table->unsignedInteger('training_course_objective_id')->after('course_evaluation_sub_section_id')->nullable();
            $table->unsignedInteger('course_evaluation_questionnaire_id')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('course_evaluation_submission_details', 'question_type')) {
            Schema::table('course_evaluation_submission_details', function (Blueprint $table) {
                $table->dropColumn('question_type');
            });
        }
        if (Schema::hasColumn('course_evaluation_submission_details', 'training_course_objective_id')) {
            Schema::table('course_evaluation_submission_details', function (Blueprint $table) {
                $table->dropColumn('training_course_objective_id');
            });
        }
        if (Schema::hasColumn('course_evaluation_submission_details', 'course_evaluation_sub_section_id')) {
            Schema::table('course_evaluation_submission_details', function (Blueprint $table) {
                $table->dropColumn('course_evaluation_sub_section_id');
            });
        }

    }
}

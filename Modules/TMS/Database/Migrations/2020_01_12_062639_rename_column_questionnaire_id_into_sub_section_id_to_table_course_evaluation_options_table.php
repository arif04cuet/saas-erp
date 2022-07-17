<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnQuestionnaireIdIntoSubSectionIdToTableCourseEvaluationOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_evaluation_options', function (Blueprint $table) {
            if(Schema::hasColumn('course_evaluation_options', 'course_evaluation_questionnaire_id')) {
                $table->renameColumn('course_evaluation_questionnaire_id', 'course_evaluation_sub_section_id');
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
        Schema::table('course_evaluation_options', function (Blueprint $table) {
            if(Schema::hasColumn('course_evaluation_options', 'course_evaluation_sub_section_id')) {
                $table->renameColumn('course_evaluation_sub_section_id', 'course_evaluation_questionnaire_id');
            }
        });
    }
}

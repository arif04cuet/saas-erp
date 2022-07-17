<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

const TOPIC = 'topic';
const COURSE_NAME = 'course_name';
const TRAINING_ID = 'training_id';
const EMPLOYEE_ID = 'employee_id';
const SESSION_NAME = 'session_name';
const TRAINING_COURSE_ID = 'training_course_id';
const TRAINING_COURSE_RESOURCE_ID = 'training_course_resource_id';
const TRAINING_SPEAKER_ASSESSMENTS = 'training_speaker_assessments';
const TRAINING_COURSE_MODULE_SESSION_ID = 'training_course_module_session_id';

class Update2TrainingSpeakerAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            if (Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, TRAINING_ID)) {
                $table->dropColumn(TRAINING_ID);
            }

            if (Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, TOPIC)) {
                $table->dropColumn(TOPIC);
            }

            $this->modifyColumn(
                $table,
                TRAINING_SPEAKER_ASSESSMENTS,
                COURSE_NAME,
                TRAINING_COURSE_ID
            );
            $this->modifyColumn(
                $table,
                TRAINING_SPEAKER_ASSESSMENTS,
                SESSION_NAME,
                TRAINING_COURSE_MODULE_SESSION_ID
            );

            if (Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, EMPLOYEE_ID)) {
                $table->renameColumn(EMPLOYEE_ID, TRAINING_COURSE_RESOURCE_ID);
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
        Schema::table('training_speaker_assessments', function (Blueprint $table) {
            if (!Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, TRAINING_ID)) {
                $table->unsignedInteger(TRAINING_ID);
            }
            if (Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, TRAINING_COURSE_ID)) {
                $table->dropColumn(TRAINING_COURSE_ID);
                $table->string(COURSE_NAME, 191);
            }
            if (Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, TRAINING_COURSE_MODULE_SESSION_ID)) {
                $table->dropColumn(TRAINING_COURSE_MODULE_SESSION_ID);
                $table->string(SESSION_NAME, 191);
            }
            if (Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, TRAINING_COURSE_RESOURCE_ID)) {
                $table->renameColumn(TRAINING_COURSE_RESOURCE_ID, EMPLOYEE_ID);
            }
            if (!Schema::hasColumn(TRAINING_SPEAKER_ASSESSMENTS, TOPIC)) {
                $table->string(TOPIC, 255);
            }
        });
    }

    /**
     * @param Blueprint $table
     * @param string $tableName
     * @param string $oldColumn
     * @param string $newColumn
     */
    private function modifyColumn(Blueprint $table, string $tableName, string $oldColumn, string $newColumn): void
    {
        if (Schema::hasColumn($tableName, $oldColumn)) {
            $table->dropColumn($oldColumn);
            $table->unsignedInteger($newColumn);
        }
    }
}

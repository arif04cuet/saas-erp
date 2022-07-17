<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingCafeteriaIdAddEntityTypeToTrainingCourseBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_course_breaks', function (Blueprint $table) {
            if(Schema::hasColumn('training_course_breaks', 'type')) {
                DB::statement("ALTER TABLE training_course_breaks DROP COLUMN `type`");
            }

            if (Schema::hasColumn('training_course_breaks', 'training_cafeteria_id')) {

                $table->renameColumn('training_cafeteria_id', 'entity_id');
            }

            if (!Schema::hasColumn('training_course_breaks', 'entity_type')) {

                $table->string('entity_type', 255);
            }

            if (!Schema::hasColumn('training_course_breaks', 'title')) {

                $table->string('title', 255);
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
            if(!Schema::hasColumn('training_course_breaks', 'type')) {
                $table->enum('type', ['breakfast', 'tea-break', 'lunch', 'dinner']);
            }

            if (Schema::hasColumn('training_course_breaks', 'entity_id')) {

                $table->renameColumn('entity_id', 'training_cafeteria_id');
            }

            if (Schema::hasColumn('training_course_breaks', 'entity_type')) {

                $table->dropColumn('entity_type');
            }

            if (Schema::hasColumn('training_course_breaks', 'title')) {

                $table->dropColumn('title');
            }
        });
    }
}

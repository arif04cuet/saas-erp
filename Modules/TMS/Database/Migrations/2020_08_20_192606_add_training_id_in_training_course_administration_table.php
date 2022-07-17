<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingIdInTrainingCourseAdministrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->registerEnumWithDoctrine();
        if (!Schema::hasColumn('training_course_administrations', 'training_id')) {
            Schema::table('training_course_administrations', function (Blueprint $table) {
                $table->unsignedInteger('training_id')->after('id')->nullable();
            });
        }
        if (Schema::hasColumn('training_course_administrations', 'training_course_id')) {
            Schema::table('training_course_administrations', function (Blueprint $table) {
                $table->unsignedInteger('training_course_id')->nullable(true)->change();
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
        $this->registerEnumWithDoctrine();
        if (Schema::hasColumn('training_course_administrations', 'training_id')) {
            Schema::table('training_course_administrations', function (Blueprint $table) {
                $table->dropColumn('training_id');
            });
        }
        if (Schema::hasColumn('training_course_administrations', 'training_course_id')) {
            Schema::table('training_course_administrations', function (Blueprint $table) {
                $table->unsignedInteger('training_course_id')->nullable(false)->change();
            });
        }
    }

    /**
     * Any table that has a enum type column, changing other column will also run into
     * 'Unknown database type enum requested, Doctrine\DBAL\Platforms\MySQL57Platform' Exception
     * Workaround:
     * @link https://chasingcode.dev/blog/update-enum-column-doctrine-exception/
     */

    private function registerEnumWithDoctrine()
    {
        DB::getDoctrineSchemaManager()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('enum', 'string');
    }
}

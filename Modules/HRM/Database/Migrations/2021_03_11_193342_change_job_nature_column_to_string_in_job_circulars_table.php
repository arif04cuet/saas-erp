<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeJobNatureColumnToStringInJobCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->registerEnumWithDoctrine();

        // removing enum and insert as string
        if (Schema::hasColumn('job_circulars', 'job_nature')) {
            Schema::table('job_circulars', function (Blueprint $table) {
                $table->dropColumn('job_nature');
            });
        }

        if (!Schema::hasColumn('job_circulars', 'job_nature')) {
            Schema::table('job_circulars', function (Blueprint $table) {
                $table->string('job_nature')
                    ->nullable();
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
        //
    }

    private function registerEnumWithDoctrine()
    {
        DB::getDoctrineSchemaManager()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('enum', 'string');
    }
}

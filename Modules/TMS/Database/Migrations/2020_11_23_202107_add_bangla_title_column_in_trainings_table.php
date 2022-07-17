<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaTitleColumnInTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trainings', 'bangla_title')) {
            Schema::table('trainings', function (Blueprint $table) {
                $table->string('bangla_title')->after('title')->nullable();
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
        if (Schema::hasColumn('trainings', 'bangla_title')) {
            Schema::table('trainings', function (Blueprint $table) {
                $table->dropColumn('bangla_title');
            });
        }
    }
}

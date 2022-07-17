<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLangPreferenceInTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $langPreference = \Modules\TMS\Entities\Training::getLangPreferences();
        if (!Schema::hasColumn('trainings', 'lang_preference')) {
            Schema::table('trainings', function (Blueprint $table) use ($langPreference) {
                $table->string('lang_preference')->default($langPreference['both']);
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
        if (Schema::hasColumn('trainings', 'lang_preference')) {
            Schema::table('trainings', function (Blueprint $table) {
                $table->dropColumn('lang_preference');
            });
        }

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLangFieldsNullableToTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('trainees', 'badge_name_bn')) {
            Schema::table('trainees', function (Blueprint $table) {
                $table->string('badge_name_bn')->nullable()->change();
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
        if (Schema::hasColumn('trainees', 'badge_name_bn')) {
            Schema::table('trainees', function (Blueprint $table) {
                $table->string('badge_name_bn')->nullable(false)->change();
            });
        }
    }
}

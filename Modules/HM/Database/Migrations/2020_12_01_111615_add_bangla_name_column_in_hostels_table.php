<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaNameColumnInHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('hostels', 'bangla_name')) {
            Schema::table('hostels', function (Blueprint $table) {
                $table->string('bangla_name')->after('name')->nullable();
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
        if (Schema::hasColumn('hostels', 'bangla_name')) {
            Schema::table('hostels', function (Blueprint $table) {
                $table->dropColumn('bangla_name');
            });
        }

    }
}

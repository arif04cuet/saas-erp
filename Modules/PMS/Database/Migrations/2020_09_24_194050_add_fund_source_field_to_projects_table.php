<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFundSourceFieldToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('projects', 'fund_source')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->text('fund_source')->after('budget')->nullable();
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
        if (Schema::hasColumn('projects', 'fund_source')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('fund_source');
            });
        }

    }
}

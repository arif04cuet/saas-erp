<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaximumAllowedDaysInLeaveTypePurposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('leave_type_purposes', 'amount')) {
            Schema::table('leave_type_purposes', function (Blueprint $table) {
                $table->integer('amount')
                    ->after('name')
                    ->default(0);
            });
        }

        if (!Schema::hasColumn('leave_type_purposes', 'maximum_allowed_days')) {
            Schema::table('leave_type_purposes', function (Blueprint $table) {
                $table->integer('maximum_allowed_days')
                    ->after('amount')
                    ->default(0);
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
        if (Schema::hasColumn('leave_type_purposes', 'maximum_allowed_days')) {
            Schema::table('leave_type_purposes', function (Blueprint $table) {
                $table->dropColumn('maximum_allowed_days');
            });
        }
        if (Schema::hasColumn('leave_type_purposes', 'amount')) {
            Schema::table('leave_type_purposes', function (Blueprint $table) {
                $table->dropColumn('amount');
            });
        }

    }
}

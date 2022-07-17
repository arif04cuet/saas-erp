<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('leave_types', 'amount')) {
            Schema::table('leave_types', function (Blueprint $table) {
                $table->integer('amount')->nullable();
                $table->integer('maximum_allowed_days')->nullable();
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
        if (Schema::hasColumn('leave_types', 'amount')) {
            Schema::table('leave_types', function (Blueprint $table) {
                $table->dropColumn('amount');
                $table->dropColumn('maximum_allowed_days');

            });
        }
    }
}

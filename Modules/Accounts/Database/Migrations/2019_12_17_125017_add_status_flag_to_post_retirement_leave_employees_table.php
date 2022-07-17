<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Accounts\Entities\PostRetirementLeaveEmployee;

class AddStatusFlagToPostRetirementLeaveEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_retirement_leave_employees', function (Blueprint $table) {
            $table->enum('status', PostRetirementLeaveEmployee::status)
                ->default(PostRetirementLeaveEmployee::status[0])
                ->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_retirement_leave_employees', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

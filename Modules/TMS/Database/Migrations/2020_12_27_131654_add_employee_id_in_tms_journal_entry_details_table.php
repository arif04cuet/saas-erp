<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeIdInTmsJournalEntryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('tms_journal_entry_details', 'employee_id')) {
            Schema::table('tms_journal_entry_details', function (Blueprint $table) {
                $table->unsignedInteger('employee_id')
                    ->after('tms_journal_entry_id')->nullable();
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
        if (Schema::hasColumn('tms_journal_entry_details', 'employee_id')) {
            Schema::table('tms_journal_entry_details', function (Blueprint $table) {
                $table->dropColumn('employee_id');
            });
        }


    }
}

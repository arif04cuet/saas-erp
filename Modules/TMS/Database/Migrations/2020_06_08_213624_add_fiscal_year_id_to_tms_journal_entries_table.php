<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiscalYearIdToTmsJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tms_journal_entries', function (Blueprint $table) {
            $table->unsignedInteger('fiscal_year_id')
                ->nullable(false)
                ->after('journal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('tms_journal_entries', 'fiscal_year_id')) {
            Schema::table('tms_journal_entries', function (Blueprint $table) {
                $table->dropColumn('fiscal_year_id');
            });
        }

    }
}

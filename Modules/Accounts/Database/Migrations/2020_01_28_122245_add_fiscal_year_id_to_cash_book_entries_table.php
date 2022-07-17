<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiscalYearIdToCashBookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cash_book_entries', function (Blueprint $table) {
            $table->unsignedInteger('fiscal_year_id')->nullable(false)->after('journal_entry_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('cash_book_entries', 'fiscal_year_id')) {
            Schema::table('cash_book_entries', function (Blueprint $table) {
                $table->dropColumn('fiscal_year_id');
            });
        }
    }
}

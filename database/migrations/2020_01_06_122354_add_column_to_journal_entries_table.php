<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journal_entries', function (Blueprint $table) {
            $table->unsignedInteger('fiscal_year_id')->nullable(false)->after('journal_id');
            $table->double('total_amount')->default(0.0)->after('fiscal_year_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasColumn('journal_entries', 'fiscal_year_id')) {
            Schema::table('journal_entries', function (Blueprint $table) {
                $table->dropColumn('fiscal_year_id');
            });
        }

        if (Schema::hasColumn('journal_entries', 'total_amount')) {
            Schema::table('journal_entries', function (Blueprint $table) {
                $table->dropColumn('total_amount');
            });
        }

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusToJournalEntryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journal_entry_details', function (Blueprint $table) {
            $table->enum('status', \Modules\Accounts\Entities\JournalEntryDetail::getStatuses())
                ->default(\Modules\Accounts\Entities\JournalEntryDetail::getStatuses()[0])
                ->after('remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journal_entry_details', function (Blueprint $table) {
            if (Schema::hasColumn('journal_entry_details', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}

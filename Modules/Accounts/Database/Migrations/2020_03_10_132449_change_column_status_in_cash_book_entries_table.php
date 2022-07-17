<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnStatusInCashBookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // doctrine package do not support changing column type of "enum" [ from the laravel doc]
        // so changing manually
        Schema::table('cash_book_entries', function (Blueprint $table) {
            $status = array_keys(Config('constants.journal_entry.statuses'));
            $statusAsString = implode("','", $status);
            DB::statement("ALTER TABLE cash_book_entries CHANGE COLUMN status status enum ('" . $statusAsString . "')
             DEFAULT 'draft'");
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::table('cash_book_entries', function (Blueprint $table) {
            $statusAsString = "'draft','approved'";
            DB::statement("ALTER TABLE cash_book_entries CHANGE COLUMN status status enum (" . $statusAsString . ")
             DEFAULT 'draft'");
        });
    }
}

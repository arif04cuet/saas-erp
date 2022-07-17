<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropJournalEntriesTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columns = [];

        if (Schema::hasColumn('journal_entries', 'debit_amount')) ;
        {
            array_push($columns, 'debit_amount');
        }

        if (Schema::hasColumn('journal_entries', 'department_id')) ;
        {
            array_push($columns, 'department_id');
        }

        if (Schema::hasColumn('journal_entries', 'credit_amount')) ;
        {
            array_push($columns, 'credit_amount');
        }

        if (Schema::hasColumn('journal_entries', 'description')) ;
        {
            array_push($columns, 'description');
        }

        if (Schema::hasColumn('journal_entries', 'account_id')) ;
        {
            array_push($columns, 'account_id');
        }

        if (count($columns)) {
            Schema::table('journal_entries', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }

    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('journal_entries', function (Blueprint $table) {
            $table->unsignedInteger('account_id')->nullable(false);
            $table->unsignedInteger('department_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('debit_amount')->nullable();
            $table->integer('credit_amount')->nullable();
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmCashBookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_cash_book_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fiscal_year_id')->nullable(false);
            $table->unsignedInteger('hm_journal_entry_detail_id')->nullable(false);
            $table->string('payment_type');
            $table->double('amount')->default(0.0);
            $table->date('date');
            $table->string('status')->default($this->getDraftStatus());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hm_cash_book_entries');
    }

    private function getDraftStatus()
    {
        $draft = \Modules\HM\Entities\HmJournalEntry::getStatuses()['draft'];
        return strtolower($draft);
    }
}

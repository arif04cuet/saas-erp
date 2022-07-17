<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmJournalEntryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_journal_entry_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hm_journal_entry_id')->nullable(false);
            $table->unsignedInteger('hostel_budget_section_id')->nullable(false);
            $table->string('transaction_type');
            $table->double('credit_amount')->default(0.0);
            $table->double('debit_amount')->default(0.0);
            $table->boolean('is_cash_book_entry')->default(false);
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('hm_journal_entry_details');
    }

    private function getDraftStatus()
    {
        $draft = \Modules\HM\Entities\HmJournalEntry::getStatuses()['draft'];
        return strtolower($draft);
    }
}

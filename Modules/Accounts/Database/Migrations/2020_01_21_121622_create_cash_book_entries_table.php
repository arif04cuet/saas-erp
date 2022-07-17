<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashBookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_book_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('journal_entry_detail_id')->nullable(false);
            $table->enum('payment_type', \Modules\Accounts\Entities\JournalEntryDetail::getPaymentTypes())
                ->default(\Modules\Accounts\Entities\JournalEntryDetail::getPaymentTypes()[0]);
            $table->double('amount')->default(0.0);
            $table->enum('status', ['draft', 'approved'])->default('draft');
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
        Schema::dropIfExists('cash_book_entries');
    }
}

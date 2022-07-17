<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsJournalEntryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_journal_entry_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tms_journal_entry_id')->nullable(false);
            $table->unsignedInteger('tms_sub_sector_id')->nullable(false);
            $table->enum('transaction_type', config('tms.constants.accounts.transaction_type'))
                ->default(config('tms.constants.accounts.transaction_type')[0])
                ->nullable(false);
            $table->double('credit_amount')->default(0.0);
            $table->double('debit_amount')->default(0.0);
            $table->boolean('is_cash_book_entry')->default(false);
            $table->string('remark')->nullable();
            $table->enum('status', config('tms.constants.accounts.statuses'))
                ->default(config('tms.constants.accounts.statuses')[0]);
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
        Schema::dropIfExists('tms_journal_entry_details');
    }
}

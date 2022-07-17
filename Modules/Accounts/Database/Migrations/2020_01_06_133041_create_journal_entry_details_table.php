<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalEntryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_entry_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('journal_entry_id')->nullable(false);
            $table->string('economy_code')->nullable(false); // every transaction should have a corresponding code
            $table->integer('credit_amount')->default(0);
            $table->integer('debit_amount')->default(0);
            $table->enum('source', \Modules\Accounts\Entities\JournalEntryDetail::getSources());
            $table->enum('account_transaction_type', \Modules\Accounts\Entities\JournalEntryDetail::getTransactionTypes());
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('journal_entry_details');
    }
}

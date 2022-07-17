<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsCashBookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_cash_book_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_id')->nullable(false);
            $table->unsignedInteger('tms_journal_entry_detail_id')->nullable(false);
            $table->enum('payment_type', config('tms.constants.accounts.payment_type'))
                ->default(config('tms.constants.accounts.payment_type')[0]);
            $table->double('amount')->default(0.0);
            $table->date('date')->nullable(false);
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
        Schema::dropIfExists('tms_cash_book_entries');
    }
}

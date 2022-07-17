<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_journal_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_id')->nullable(false);
            $table->unsignedInteger('journal_id')->nullable(true);
            $table->string('title')->nullable(false);
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
        Schema::dropIfExists('tms_journal_entries');
    }
}

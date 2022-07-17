<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_journal_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fiscal_year_id')->nullable(false);
            $table->unsignedInteger('hostel_budget_title_id')->nullable(false);
            $table->unsignedInteger('journal_id')->nullable();
            $table->string('title');
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
        Schema::dropIfExists('hm_journal_entries');
    }

    private function getDraftStatus()
    {
        $draft = \Modules\HM\Entities\HmJournalEntry::getStatuses()['draft'];
        return strtolower($draft);
    }
}

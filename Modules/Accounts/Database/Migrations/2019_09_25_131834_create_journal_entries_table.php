<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->date('date')->nullable(false);
            $table->unsignedInteger('journal_id')->nullable();
            $table->unsignedInteger('account_id')->nullable(false);
            $table->text('description')->nullable();
            $table->integer('debit_amount')->nullable();
            $table->integer('credit_amount')->nullable();
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
        Schema::dropIfExists('journal_entries');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_head_id');
            $table->string('name', 120);
            $table->string('code', 20)->nullable();
            $table->string('opening_balance_type', 4);
            $table->double('opening_balance', 10, 2)->default(0);
            $table->double('closing_balance', 10, 2)->default(0);
            $table->string('account_type', 20)->nullable();
            $table->boolean('reconciliation')->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('account_ledgers');
    }
}

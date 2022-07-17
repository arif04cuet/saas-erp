<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEconomyCodeToAccountTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_transaction_histories', function (Blueprint $table) {
            $table->string('economy_code')->nullable(false)->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('account_transaction_histories', 'economy_code')) {
            Schema::table('account_transaction_histories', function (Blueprint $table) {
                $table->dropColumn('economy_code');
            });
        }
    }
}

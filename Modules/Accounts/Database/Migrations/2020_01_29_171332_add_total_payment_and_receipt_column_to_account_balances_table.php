<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalPaymentAndReceiptColumnToAccountBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_balances', function (Blueprint $table) {
            $table->double('total_local_payment')->default(0.0)->after('initial_revenue_balance');
            $table->double('total_local_receipt')->default(0.0)->after('total_local_payment');
            $table->double('total_revenue_payment')->default(0.0)->after('total_local_receipt');
            $table->double('total_revenue_receipt')->default(0.0)->after('total_revenue_payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_balances', function (Blueprint $table) {

            $columns = ['total_local_payment', 'total_local_receipt', 'total_revenue_payment', 'total_revenue_receipt'];
            //drop all the column from array
            for ($i = 0; $i < count($columns); $i++) {
                if (Schema::hasColumn('account_balances', $columns[$i])) {
                    $table->dropColumn($columns[$i]);
                }
            }
        });
    }
}

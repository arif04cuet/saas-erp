<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class AddIsUsedForRevenueBudgetColumnToEconomyCodeTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('economy_codes', function (Blueprint $table) {
                $table->boolean('is_used_for_revenue_budget')->after('economy_head_code')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('economy_codes', function (Blueprint $table) {
                $table->dropColumn('is_used_for_revenue_budget');
            });
        }
    }

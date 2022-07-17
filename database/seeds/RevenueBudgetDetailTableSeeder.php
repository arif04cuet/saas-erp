<?php

    use Illuminate\Database\Seeder;

    class RevenueBudgetDetailTableSeeder extends Seeder
    {

        const COLUMN_REVENUE_BUDGET_REFERENCE = 'revenue_budget_id';
        const COLUMN_ECONOMIC_CODE = 'economy_code';

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            \DB::table('revenue_budget_details')->truncate();
            \DB::table('revenue_budget_details')->insert([
                0 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111101,
                ],
                1 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111201,
                ],
                2 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111202,
                ],
                3 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111302,
                ],
                4 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111306,
                ],

                5 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111310,
                ],
                6 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111310,
                ],
                7 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3111338,
                ],
                8 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3211114,
                ],
                9 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3211116,
                ],
                10 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3211118,
                ],
                11 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3242102,
                ],
                12 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3243102,
                ],
                12 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3251109,
                ],
                13 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3258107,
                ],
                14 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3258120,
                ],
                15 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3258128,
                ],
                15 => [
                    self::COLUMN_REVENUE_BUDGET_REFERENCE => 1,
                    self::COLUMN_ECONOMIC_CODE => 3521101,
                ],
            ]);
        }
    }

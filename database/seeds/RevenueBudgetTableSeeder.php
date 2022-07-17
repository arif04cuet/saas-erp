<?php

    use Illuminate\Database\Seeder;

    class RevenueBudgetTableSeeder extends Seeder
    {
        const COLUMN_FISCAL_YEAR_REFERENCE = 'fiscal_year_id';

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            \DB::table('revenue_budgets')->truncate();

            \DB::table('revenue_budgets')->insert([
                0 => [
                    self::COLUMN_FISCAL_YEAR_REFERENCE => 1,
                ]
            ]);
        }
    }

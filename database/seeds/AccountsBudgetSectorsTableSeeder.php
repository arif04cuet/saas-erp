<?php

use Illuminate\Database\Seeder;

class AccountsBudgetSectorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('accounts_budget_sectors')->delete();
        
        \DB::table('accounts_budget_sectors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'accounts_budget_id' => 1,
                'code' => 3111101,
                'local_amount' => 38000000.0,
                'revenue_amount' => 38000000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 38000000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            1 => 
            array (
                'id' => 2,
                'accounts_budget_id' => 1,
                'code' => 3111201,
                'local_amount' => 50050000.0,
                'revenue_amount' => 50050000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 50050000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            2 => 
            array (
                'id' => 3,
                'accounts_budget_id' => 1,
                'code' => 3111302,
                'local_amount' => 1128000.0,
                'revenue_amount' => 1128000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1128000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            3 => 
            array (
                'id' => 4,
                'accounts_budget_id' => 1,
                'code' => 3111306,
                'local_amount' => 1800000.0,
                'revenue_amount' => 1800000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1800000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            4 => 
            array (
                'id' => 5,
                'accounts_budget_id' => 1,
                'code' => 3111310,
                'local_amount' => 15900000.0,
                'revenue_amount' => 15900000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 15900000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            5 => 
            array (
                'id' => 6,
                'accounts_budget_id' => 1,
                'code' => 3111311,
                'local_amount' => 5500000.0,
                'revenue_amount' => 5500000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 5500000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            6 => 
            array (
                'id' => 7,
                'accounts_budget_id' => 1,
                'code' => 3111314,
                'local_amount' => 600000.0,
                'revenue_amount' => 600000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 600000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            7 => 
            array (
                'id' => 8,
                'accounts_budget_id' => 1,
                'code' => 3111316,
                'local_amount' => 130000.0,
                'revenue_amount' => 130000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 130000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            8 => 
            array (
                'id' => 9,
                'accounts_budget_id' => 1,
                'code' => 3111325,
                'local_amount' => 15000000.0,
                'revenue_amount' => 15000000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 15000000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            9 => 
            array (
                'id' => 10,
                'accounts_budget_id' => 1,
                'code' => 3111328,
                'local_amount' => 1100000.0,
                'revenue_amount' => 1100000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1100000,
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            10 => 
            array (
                'id' => 11,
                'accounts_budget_id' => 1,
                'code' => 3111331,
                'local_amount' => 20000.0,
                'revenue_amount' => 20000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 20000,
                'created_at' => '2020-01-08 17:26:37',
                'updated_at' => '2020-01-28 14:22:13',
            ),
            11 => 
            array (
                'id' => 12,
                'accounts_budget_id' => 1,
                'code' => 3111335,
                'local_amount' => 1340000.0,
                'revenue_amount' => 1340000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1340000,
                'created_at' => '2020-01-08 17:26:37',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            12 => 
            array (
                'id' => 13,
                'accounts_budget_id' => 1,
                'code' => 3111338,
                'local_amount' => 8647000.0,
                'revenue_amount' => 8647000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 8647000,
                'created_at' => '2020-01-08 17:26:37',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            13 => 
            array (
                'id' => 14,
                'accounts_budget_id' => 1,
                'code' => 3211106,
                'local_amount' => 600000.0,
                'revenue_amount' => 600000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 600000,
                'created_at' => '2020-01-08 17:26:37',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            14 => 
            array (
                'id' => 15,
                'accounts_budget_id' => 1,
                'code' => 3211109,
                'local_amount' => 4830000.0,
                'revenue_amount' => 4830000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 4830000,
                'created_at' => '2020-01-08 17:26:37',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            15 => 
            array (
                'id' => 16,
                'accounts_budget_id' => 1,
                'code' => 3211111,
                'local_amount' => 8700000.0,
                'revenue_amount' => 8700000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 8700000,
                'created_at' => '2020-01-08 17:26:37',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            16 => 
            array (
                'id' => 17,
                'accounts_budget_id' => 1,
                'code' => 3211113,
                'local_amount' => 9000000.0,
                'revenue_amount' => 9000000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 9000000,
                'created_at' => '2020-01-08 17:37:31',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            17 => 
            array (
                'id' => 18,
                'accounts_budget_id' => 1,
                'code' => 3211117,
                'local_amount' => 1550000.0,
                'revenue_amount' => 1550000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1550000,
                'created_at' => '2020-01-08 17:37:31',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            18 => 
            array (
                'id' => 19,
                'accounts_budget_id' => 1,
                'code' => 3211119,
                'local_amount' => 50000.0,
                'revenue_amount' => 50000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 50000,
                'created_at' => '2020-01-08 17:37:31',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            19 => 
            array (
                'id' => 20,
                'accounts_budget_id' => 1,
                'code' => 3211120,
                'local_amount' => 425000.0,
                'revenue_amount' => 425000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 425000,
                'created_at' => '2020-01-08 17:37:31',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            20 => 
            array (
                'id' => 21,
                'accounts_budget_id' => 1,
                'code' => 3211127,
                'local_amount' => 370000.0,
                'revenue_amount' => 370000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 370000,
                'created_at' => '2020-01-08 17:37:31',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            21 => 
            array (
                'id' => 22,
                'accounts_budget_id' => 1,
                'code' => 3211129,
                'local_amount' => 475000.0,
                'revenue_amount' => 475000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 475000,
                'created_at' => '2020-01-08 17:37:31',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            22 => 
            array (
                'id' => 23,
                'accounts_budget_id' => 1,
                'code' => 3241101,
                'local_amount' => 1800000.0,
                'revenue_amount' => 1800000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1800000,
                'created_at' => '2020-01-08 17:50:28',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            23 => 
            array (
                'id' => 24,
                'accounts_budget_id' => 1,
                'code' => 3243101,
                'local_amount' => 3500000.0,
                'revenue_amount' => 3500000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 3500000,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            24 => 
            array (
                'id' => 25,
                'accounts_budget_id' => 1,
                'code' => 3255105,
                'local_amount' => 2500000.0,
                'revenue_amount' => 2500000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 2500000,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            25 => 
            array (
                'id' => 26,
                'accounts_budget_id' => 1,
                'code' => 3257103,
                'local_amount' => 20000000.0,
                'revenue_amount' => 20000000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 20000000,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            26 => 
            array (
                'id' => 27,
                'accounts_budget_id' => 1,
                'code' => 3258101,
                'local_amount' => 1600000.0,
                'revenue_amount' => 1600000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1600000,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            27 => 
            array (
                'id' => 28,
                'accounts_budget_id' => 1,
                'code' => 3258104,
                'local_amount' => 4500000.0,
                'revenue_amount' => 4500000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 4500000,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            28 => 
            array (
                'id' => 29,
                'accounts_budget_id' => 1,
                'code' => 3258108,
                'local_amount' => 8500000.0,
                'revenue_amount' => 8500000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 8500000,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            29 => 
            array (
                'id' => 30,
                'accounts_budget_id' => 1,
                'code' => 3258117,
                'local_amount' => 317000.0,
                'revenue_amount' => 317000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 317000,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            30 => 
            array (
                'id' => 31,
                'accounts_budget_id' => 1,
                'code' => 3421502,
                'local_amount' => 14023000.0,
                'revenue_amount' => 0,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 0,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            31 => 
            array (
                'id' => 32,
                'accounts_budget_id' => 1,
                'code' => 3721102,
                'local_amount' => 316000.0,
                'revenue_amount' => 0,
                'revised_local_amount' => 316000,
                'revised_revenue_amount' => 0,
                'created_at' => '2020-01-08 18:05:34',
                'updated_at' => '2020-01-08 18:05:34',
            ),
            32 => 
            array (
                'id' => 33,
                'accounts_budget_id' => 1,
                'code' => 3721108,
                'local_amount' => 1600000.0,
                'revenue_amount' => 1600000,
                'revised_local_amount' => 1600000,
                'revised_revenue_amount' => 0,
                'created_at' => '2020-01-08 18:17:22',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            33 => 
            array (
                'id' => 34,
                'accounts_budget_id' => 1,
                'code' => 3731101,
                'local_amount' => 27000000.0,
                'revenue_amount' => 27000000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 27000000,
                'created_at' => '2020-01-08 18:17:22',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            34 => 
            array (
                'id' => 35,
                'accounts_budget_id' => 1,
                'code' => 3731103,
                'local_amount' => 35500000.0,
                'revenue_amount' => 35500000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 35500000,
                'created_at' => '2020-01-08 18:17:22',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            35 => 
            array (
                'id' => 36,
                'accounts_budget_id' => 1,
                'code' => 3821102,
                'local_amount' => 900000.0,
                'revenue_amount' => 900000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 900000,
                'created_at' => '2020-01-08 18:17:22',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            36 => 
            array (
                'id' => 37,
                'accounts_budget_id' => 1,
                'code' => 3821112,
                'local_amount' => 2800000.0,
                'revenue_amount' => 2800000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 2800000,
                'created_at' => '2020-01-08 18:17:22',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            37 => 
            array (
                'id' => 38,
                'accounts_budget_id' => 1,
                'code' => 3821116,
                'local_amount' => 211000.0,
                'revenue_amount' => 211000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 211000,
                'created_at' => '2020-01-08 18:17:22',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            38 => 
            array (
                'id' => 39,
                'accounts_budget_id' => 1,
                'code' => 3632102,
                'local_amount' => 1068000.0,
                'revenue_amount' => 1068000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1068000,
                'created_at' => '2020-01-08 18:17:22',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            39 => 
            array (
                'id' => 40,
                'accounts_budget_id' => 1,
                'code' => 3632105,
                'local_amount' => 5000000.0,
                'revenue_amount' => 5000000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 5000000,
                'created_at' => '2020-01-08 18:22:25',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            40 => 
            array (
                'id' => 41,
                'accounts_budget_id' => 1,
                'code' => 7215101,
                'local_amount' => 1100000.0,
                'revenue_amount' => 1100000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 1100000,
                'created_at' => '2020-01-08 18:22:25',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            41 => 
            array (
                'id' => 42,
                'accounts_budget_id' => 1,
                'code' => 7215102,
                'local_amount' => 150000.0,
                'revenue_amount' => 150000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 150000,
                'created_at' => '2020-01-08 18:22:25',
                'updated_at' => '2020-01-28 14:22:14',
            ),
            42 => 
            array (
                'id' => 43,
                'accounts_budget_id' => 1,
                'code' => 7215105,
                'local_amount' => 600000.0,
                'revenue_amount' => 600000,
                'revised_local_amount' => 0,
                'revised_revenue_amount' => 600000,
                'created_at' => '2020-01-08 18:22:25',
                'updated_at' => '2020-01-28 14:22:14',
            ),
        ));
        
        
    }
}
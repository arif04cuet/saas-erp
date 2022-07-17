<?php

use Illuminate\Database\Seeder;

class TmsAccountBalancesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tms_account_balances')->delete();
        
        \DB::table('tms_account_balances')->insert(array (
            0 => 
            array (
                'id' => 1,
                'training_id' => 1,
                'tms_sub_sector_id' => 1,
                'total_receive_amount' => 7055.0,
                'total_payment_amount' => 390734.0,
                'created_at' => '2020-05-03 16:06:38',
                'updated_at' => '2020-05-07 19:24:52',
            ),
            1 => 
            array (
                'id' => 2,
                'training_id' => 1,
                'tms_sub_sector_id' => 3,
                'total_receive_amount' => 20000.0,
                'total_payment_amount' => 0.0,
                'created_at' => '2020-05-03 16:15:13',
                'updated_at' => '2020-05-03 16:15:13',
            ),
            2 => 
            array (
                'id' => 3,
                'training_id' => 1,
                'tms_sub_sector_id' => 2,
                'total_receive_amount' => 20600.0,
                'total_payment_amount' => 368234.0,
                'created_at' => '2020-05-03 16:15:13',
                'updated_at' => '2020-05-18 21:04:55',
            ),
            3 => 
            array (
                'id' => 4,
                'training_id' => 1,
                'tms_sub_sector_id' => 4,
                'total_receive_amount' => 0.0,
                'total_payment_amount' => 36545.0,
                'created_at' => '2020-05-05 19:42:47',
                'updated_at' => '2020-05-05 19:42:47',
            ),
            4 => 
            array (
                'id' => 5,
                'training_id' => 2,
                'tms_sub_sector_id' => 8,
                'total_receive_amount' => 0.0,
                'total_payment_amount' => 500.0,
                'created_at' => '2020-05-05 20:54:12',
                'updated_at' => '2020-05-05 20:54:12',
            ),
            5 => 
            array (
                'id' => 6,
                'training_id' => 2,
                'tms_sub_sector_id' => 14,
                'total_receive_amount' => 0.0,
                'total_payment_amount' => 45000.0,
                'created_at' => '2020-05-05 20:54:12',
                'updated_at' => '2020-05-07 19:44:28',
            ),
            6 => 
            array (
                'id' => 7,
                'training_id' => 2,
                'tms_sub_sector_id' => 15,
                'total_receive_amount' => 4000.0,
                'total_payment_amount' => 3534.0,
                'created_at' => '2020-05-07 19:24:52',
                'updated_at' => '2020-05-07 19:44:28',
            ),
            7 => 
            array (
                'id' => 8,
                'training_id' => 2,
                'tms_sub_sector_id' => 18,
                'total_receive_amount' => 0.0,
                'total_payment_amount' => 54534.0,
                'created_at' => '2020-05-07 19:24:52',
                'updated_at' => '2020-05-07 19:44:28',
            ),
        ));
        
        
    }
}
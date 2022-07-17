<?php

use Illuminate\Database\Seeder;

class CheckinPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('checkin_payments')->delete();
        
        
        
    }
}
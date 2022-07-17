<?php

use Illuminate\Database\Seeder;

class BookingCheckinTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('booking_checkin')->delete();
        
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class PayscalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payscales')->delete();
        
        \DB::table('payscales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'National Payscale 2015',
                'active_from' => '2019-07-01',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-09-16 12:04:22',
            ),
        ));
        
        
    }
}
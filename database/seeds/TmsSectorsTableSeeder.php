<?php

use Illuminate\Database\Seeder;

class TmsSectorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tms_sectors')->delete();
        
        \DB::table('tms_sectors')->insert(array (
            0 => 
            array (
                'id' => 2,
                'code' => '2004290507262403',
                'title_english' => 'Payable to Trainees',
                'title_bangla' => 'প্রশিক্ষণার্থীদের প্রদেয়',
                'sequence' => 1,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            1 => 
            array (
                'id' => 3,
                'code' => '2004290522112108',
                'title_english' => 'Academy and training support sectors are provided',
                'title_bangla' => 'একাডেমী ও প্রশিক্ষণ সহায়তাকারী খাত প্রদেয়',
                'sequence' => 2,
                'details' => NULL,
                'created_at' => '2020-04-29 17:22:11',
                'updated_at' => '2020-04-29 17:22:11',
            ),
            2 => 
            array (
                'id' => 4,
                'code' => '2004290549499607',
                'title_english' => 'Training and support service sector is payable',
                'title_bangla' => 'প্রশিক্ষণ ও সাপোর্ট সার্ভিস খাত প্রদেয়',
                'sequence' => 3,
                'details' => NULL,
                'created_at' => '2020-04-29 17:49:49',
                'updated_at' => '2020-04-29 17:49:49',
            ),
        ));
        
        
    }
}
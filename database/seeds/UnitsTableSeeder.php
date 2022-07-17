<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 3,
                'bn_name' => 'কেজি',
                'en_name' => 'KG',
                'remark' => NULL,
                'created_at' => '2020-05-17 16:02:22',
                'updated_at' => '2020-05-17 16:02:22',
            ),
            1 => 
            array (
                'id' => 4,
                'bn_name' => 'প্যাকেট',
                'en_name' => 'Packet',
                'remark' => NULL,
                'created_at' => '2020-05-17 16:02:33',
                'updated_at' => '2020-05-17 16:02:33',
            ),
            2 => 
            array (
                'id' => 5,
                'bn_name' => 'লিটার',
                'en_name' => 'Liter',
                'remark' => NULL,
                'created_at' => '2020-05-17 16:02:43',
                'updated_at' => '2020-05-17 16:02:43',
            ),
            3 => 
            array (
                'id' => 7,
                'bn_name' => 'পিস',
                'en_name' => 'piece',
                'remark' => NULL,
                'created_at' => '2020-05-17 16:35:25',
                'updated_at' => '2020-05-17 16:35:25',
            ),
            4 => 
            array (
                'id' => 8,
                'bn_name' => 'প্লেট',
                'en_name' => 'plate',
                'remark' => NULL,
                'created_at' => '2020-05-17 16:35:47',
                'updated_at' => '2020-05-17 16:35:47',
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class CafeteriaInventoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cafeteria_inventories')->delete();
        
        \DB::table('cafeteria_inventories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'raw_material_id' => 1,
                'available_amount' => 71,
                'previous_amount' => 50,
                'created_at' => '2020-05-17 16:36:26',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            1 => 
            array (
                'id' => 2,
                'raw_material_id' => 2,
                'available_amount' => 50,
                'previous_amount' => 30,
                'created_at' => '2020-05-17 16:36:55',
                'updated_at' => '2020-05-17 16:47:54',
            ),
            2 => 
            array (
                'id' => 3,
                'raw_material_id' => 3,
                'available_amount' => 43,
                'previous_amount' => 23,
                'created_at' => '2020-05-17 16:38:07',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            3 => 
            array (
                'id' => 4,
                'raw_material_id' => 4,
                'available_amount' => 71,
                'previous_amount' => 50,
                'created_at' => '2020-05-17 16:38:42',
                'updated_at' => '2020-05-17 16:48:10',
            ),
            4 => 
            array (
                'id' => 5,
                'raw_material_id' => 5,
                'available_amount' => 45,
                'previous_amount' => 30,
                'created_at' => '2020-05-17 16:39:19',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            5 => 
            array (
                'id' => 6,
                'raw_material_id' => 6,
                'available_amount' => 25,
                'previous_amount' => 0,
                'created_at' => '2020-05-17 16:40:51',
                'updated_at' => '2020-05-17 16:40:51',
            ),
            6 => 
            array (
                'id' => 7,
                'raw_material_id' => 7,
                'available_amount' => 25,
                'previous_amount' => 15,
                'created_at' => '2020-05-17 16:41:37',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            7 => 
            array (
                'id' => 8,
                'raw_material_id' => 8,
                'available_amount' => 20,
                'previous_amount' => 0,
                'created_at' => '2020-05-17 16:42:45',
                'updated_at' => '2020-05-17 16:42:45',
            ),
        ));
        
        
    }
}
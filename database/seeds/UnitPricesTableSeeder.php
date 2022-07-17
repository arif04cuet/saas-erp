<?php

use Illuminate\Database\Seeder;

class UnitPricesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('unit_prices')->delete();
        
        \DB::table('unit_prices')->insert(array (
            0 => 
            array (
                'id' => 1,
                'raw_material_id' => 2,
                'category' => 'regular',
                'price' => 10,
                'created_at' => '2020-05-17 16:36:55',
                'updated_at' => '2020-05-17 16:36:55',
            ),
            1 => 
            array (
                'id' => 2,
                'raw_material_id' => 2,
                'category' => 'subsidized-officers',
                'price' => 6,
                'created_at' => '2020-05-17 16:36:55',
                'updated_at' => '2020-05-17 16:36:55',
            ),
            2 => 
            array (
                'id' => 3,
                'raw_material_id' => 2,
                'category' => 'subsidized-staffs',
                'price' => 5,
                'created_at' => '2020-05-17 16:36:55',
                'updated_at' => '2020-05-17 16:36:55',
            ),
            3 => 
            array (
                'id' => 4,
                'raw_material_id' => 4,
                'category' => 'regular',
                'price' => 10,
                'created_at' => '2020-05-17 16:38:42',
                'updated_at' => '2020-05-17 16:38:42',
            ),
            4 => 
            array (
                'id' => 5,
                'raw_material_id' => 4,
                'category' => 'subsidized-officers',
                'price' => 8,
                'created_at' => '2020-05-17 16:38:42',
                'updated_at' => '2020-05-17 16:38:42',
            ),
            5 => 
            array (
                'id' => 6,
                'raw_material_id' => 4,
                'category' => 'subsidized-staffs',
                'price' => 6,
                'created_at' => '2020-05-17 16:38:42',
                'updated_at' => '2020-05-17 16:38:42',
            ),
            6 => 
            array (
                'id' => 7,
                'raw_material_id' => 6,
                'category' => 'regular',
                'price' => 10,
                'created_at' => '2020-05-17 16:40:51',
                'updated_at' => '2020-05-17 16:40:51',
            ),
            7 => 
            array (
                'id' => 8,
                'raw_material_id' => 6,
                'category' => 'subsidized-officers',
                'price' => 6,
                'created_at' => '2020-05-17 16:40:51',
                'updated_at' => '2020-05-17 16:40:51',
            ),
            8 => 
            array (
                'id' => 9,
                'raw_material_id' => 6,
                'category' => 'subsidized-staffs',
                'price' => 8,
                'created_at' => '2020-05-17 16:40:51',
                'updated_at' => '2020-05-17 16:40:51',
            ),
            9 => 
            array (
                'id' => 10,
                'raw_material_id' => 8,
                'category' => 'regular',
                'price' => 15,
                'created_at' => '2020-05-17 16:42:45',
                'updated_at' => '2020-05-17 16:42:45',
            ),
            10 => 
            array (
                'id' => 11,
                'raw_material_id' => 8,
                'category' => 'subsidized-officers',
                'price' => 10,
                'created_at' => '2020-05-17 16:42:45',
                'updated_at' => '2020-05-17 16:42:45',
            ),
            11 => 
            array (
                'id' => 12,
                'raw_material_id' => 8,
                'category' => 'subsidized-staffs',
                'price' => 8,
                'created_at' => '2020-05-17 16:42:45',
                'updated_at' => '2020-05-17 16:42:45',
            ),
        ));
        
        
    }
}
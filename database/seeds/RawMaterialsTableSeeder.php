<?php

use Illuminate\Database\Seeder;

class RawMaterialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('raw_materials')->delete();
        
        \DB::table('raw_materials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'bn_name' => 'চাল',
                'en_name' => 'Rice',
                'unit_id' => 3,
                'short_code' => '5321',
                'type' => 'raw-item',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:36:26',
                'updated_at' => '2020-05-17 16:36:26',
            ),
            1 => 
            array (
                'id' => 2,
                'bn_name' => 'ভাত',
                'en_name' => 'Rice',
                'unit_id' => 8,
                'short_code' => '5322',
                'type' => 'finish-food',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:36:55',
                'updated_at' => '2020-05-17 16:36:55',
            ),
            2 => 
            array (
                'id' => 3,
                'bn_name' => 'মাছ-রুই',
                'en_name' => 'Fish-Rui',
                'unit_id' => 3,
                'short_code' => '5323',
                'type' => 'raw-item',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:38:07',
                'updated_at' => '2020-05-17 16:38:07',
            ),
            3 => 
            array (
                'id' => 4,
                'bn_name' => 'সিঙ্গারা',
                'en_name' => 'Singara',
                'unit_id' => 7,
                'short_code' => '5324',
                'type' => 'finish-food',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:38:42',
                'updated_at' => '2020-05-17 16:38:42',
            ),
            4 => 
            array (
                'id' => 5,
                'bn_name' => 'মসলা',
                'en_name' => 'Masala',
                'unit_id' => 4,
                'short_code' => '5325',
                'type' => 'raw-item',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:39:19',
                'updated_at' => '2020-05-17 16:39:19',
            ),
            5 => 
            array (
                'id' => 6,
                'bn_name' => 'সমুছা',
                'en_name' => 'Somucha',
                'unit_id' => 7,
                'short_code' => '5326',
                'type' => 'finish-food',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:40:51',
                'updated_at' => '2020-05-17 16:40:51',
            ),
            6 => 
            array (
                'id' => 7,
                'bn_name' => 'সয়াবিন তেল',
                'en_name' => 'Soabin Oil',
                'unit_id' => 5,
                'short_code' => '5327',
                'type' => 'raw-item',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:41:37',
                'updated_at' => '2020-05-17 16:41:37',
            ),
            7 => 
            array (
                'id' => 8,
                'bn_name' => 'ডাল',
                'en_name' => 'Dal',
                'unit_id' => 8,
                'short_code' => '5328',
                'type' => 'finish-food',
                'remark' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-17 16:42:45',
                'updated_at' => '2020-05-17 16:42:45',
            ),
        ));
        
        
    }
}
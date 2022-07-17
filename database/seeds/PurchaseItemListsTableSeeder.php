<?php

use Illuminate\Database\Seeder;

class PurchaseItemListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('purchase_item_lists')->delete();
        
        \DB::table('purchase_item_lists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'purchase_list_id' => 1,
                'raw_material_id' => 1,
                'quantity' => 21,
                'unit_id' => 3,
                'unit_price' => 21,
                'total_price' => '441',
                'status' => 'approved',
                'created_at' => '2020-05-17 16:44:24',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            1 => 
            array (
                'id' => 2,
                'purchase_list_id' => 1,
                'raw_material_id' => 3,
                'quantity' => 20,
                'unit_id' => 3,
                'unit_price' => 100,
                'total_price' => '2000',
                'status' => 'approved',
                'created_at' => '2020-05-17 16:44:24',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            2 => 
            array (
                'id' => 3,
                'purchase_list_id' => 1,
                'raw_material_id' => 5,
                'quantity' => 15,
                'unit_id' => 4,
                'unit_price' => 13,
                'total_price' => '225',
                'status' => 'approved',
                'created_at' => '2020-05-17 16:44:24',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            3 => 
            array (
                'id' => 4,
                'purchase_list_id' => 1,
                'raw_material_id' => 7,
                'quantity' => 10,
                'unit_id' => 5,
                'unit_price' => 100,
                'total_price' => '1000',
                'status' => 'approved',
                'created_at' => '2020-05-17 16:44:24',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            4 => 
            array (
                'id' => 5,
                'purchase_list_id' => 2,
                'raw_material_id' => 1,
                'quantity' => 21,
                'unit_id' => 3,
                'unit_price' => 2,
                'total_price' => '42',
                'status' => 'pending',
                'created_at' => '2020-05-17 16:44:43',
                'updated_at' => '2020-05-17 16:44:43',
            ),
            5 => 
            array (
                'id' => 6,
                'purchase_list_id' => 3,
                'raw_material_id' => 1,
                'quantity' => 11,
                'unit_id' => 3,
                'unit_price' => 12,
                'total_price' => '132',
                'status' => 'rejected',
                'created_at' => '2020-05-17 16:45:31',
                'updated_at' => '2020-05-17 16:45:51',
            ),
            6 => 
            array (
                'id' => 7,
                'purchase_list_id' => 3,
                'raw_material_id' => 5,
                'quantity' => 13,
                'unit_id' => 4,
                'unit_price' => 12,
                'total_price' => '156',
                'status' => 'rejected',
                'created_at' => '2020-05-17 16:45:31',
                'updated_at' => '2020-05-17 16:45:51',
            ),
            7 => 
            array (
                'id' => 8,
                'purchase_list_id' => 4,
                'raw_material_id' => 3,
                'quantity' => 21,
                'unit_id' => 3,
                'unit_price' => 21,
                'total_price' => '441',
                'status' => 'pending',
                'created_at' => '2020-05-17 16:46:20',
                'updated_at' => '2020-05-17 16:46:20',
            ),
        ));
        
        
    }
}
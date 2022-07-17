<?php

use Illuminate\Database\Seeder;

class CafeteriaInventoryTransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cafeteria_inventory_transactions')->delete();
        
        \DB::table('cafeteria_inventory_transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reference_table' => 'purchase-lists',
                'reference_table_id' => 1,
                'date' => '2020-05-17',
                'cafeteria_inventory_id' => 1,
                'quantity' => 21,
                'status' => 'purchased',
                'created_at' => '2020-05-17 16:45:39',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            1 => 
            array (
                'id' => 2,
                'reference_table' => 'purchase-lists',
                'reference_table_id' => 1,
                'date' => '2020-05-17',
                'cafeteria_inventory_id' => 3,
                'quantity' => 20,
                'status' => 'purchased',
                'created_at' => '2020-05-17 16:45:39',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            2 => 
            array (
                'id' => 3,
                'reference_table' => 'purchase-lists',
                'reference_table_id' => 1,
                'date' => '2020-05-17',
                'cafeteria_inventory_id' => 5,
                'quantity' => 15,
                'status' => 'purchased',
                'created_at' => '2020-05-17 16:45:39',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            3 => 
            array (
                'id' => 4,
                'reference_table' => 'purchase-lists',
                'reference_table_id' => 1,
                'date' => '2020-05-17',
                'cafeteria_inventory_id' => 7,
                'quantity' => 10,
                'status' => 'purchased',
                'created_at' => '2020-05-17 16:45:39',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            4 => 
            array (
                'id' => 5,
                'reference_table' => 'finish-foods',
                'reference_table_id' => 1,
                'date' => '2020-05-17',
                'cafeteria_inventory_id' => 2,
                'quantity' => 20,
                'status' => 'added',
                'created_at' => '2020-05-17 16:47:54',
                'updated_at' => '2020-05-17 16:47:54',
            ),
            5 => 
            array (
                'id' => 6,
                'reference_table' => 'finish-foods',
                'reference_table_id' => 2,
                'date' => '2020-05-17',
                'cafeteria_inventory_id' => 4,
                'quantity' => 21,
                'status' => 'added',
                'created_at' => '2020-05-17 16:48:10',
                'updated_at' => '2020-05-17 16:48:10',
            ),
        ));
        
        
    }
}
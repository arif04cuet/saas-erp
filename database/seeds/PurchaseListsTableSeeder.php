<?php

use Illuminate\Database\Seeder;

class PurchaseListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('purchase_lists')->delete();
        
        \DB::table('purchase_lists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'First January list',
                'purchase_date' => '2020-05-17',
                'status' => 'approved',
                'remark' => 'first comment',
                'approval_note' => NULL,
                'created_at' => '2020-05-17 16:44:24',
                'updated_at' => '2020-05-17 16:45:39',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => '2nd January List',
                'purchase_date' => '2020-05-17',
                'status' => 'draft',
                'remark' => NULL,
                'approval_note' => NULL,
                'created_at' => '2020-05-17 16:44:43',
                'updated_at' => '2020-05-17 16:44:43',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => '3rd January list',
                'purchase_date' => '2020-05-17',
                'status' => 'rejected',
                'remark' => NULL,
                'approval_note' => NULL,
                'created_at' => '2020-05-17 16:45:31',
                'updated_at' => '2020-05-17 16:45:51',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => '4th January list',
                'purchase_date' => '2020-05-17',
                'status' => 'pending',
                'remark' => NULL,
                'approval_note' => NULL,
                'created_at' => '2020-05-17 16:46:20',
                'updated_at' => '2020-05-17 16:46:20',
            ),
        ));
        
        
    }
}
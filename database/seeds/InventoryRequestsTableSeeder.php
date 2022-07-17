<?php

use Illuminate\Database\Seeder;

class InventoryRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('inventory_requests')->delete();
        
        
        
    }
}
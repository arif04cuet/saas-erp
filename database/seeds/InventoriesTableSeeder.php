<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventories')->truncate();

        DB::table('inventories')->insert([
            [
                'location_id' => 1,
                'inventory_item_category_id' => 1,
                'quantity' => 78
            ],
            [
                'location_id' => 1,
                'inventory_item_category_id' => 2,
                'quantity' => 36
            ],
            [
                'location_id' => 1,
                'inventory_item_category_id' => 3,
                'quantity' => 50
            ]

        ]);
    }
}

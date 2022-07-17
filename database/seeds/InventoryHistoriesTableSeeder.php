<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = \Carbon\Carbon::today();

        DB::table('inventory_histories')->truncate();

        DB::table('inventory_histories')->insert([
            [
                'inventory_id' => 1,
                'ref_inventory_id' => null,
                'type' => 'IN',
                'quantity' => 70,
                'is_transfer' => false,
                'created_at' => $today
            ],
            [
                'inventory_id' => 2,
                'ref_inventory_id' => null,
                'type' => 'IN',
                'quantity' => 30,
                'is_transfer' => false,
                'created_at' => $today
            ],
            [
                'inventory_id' => 3,
                'ref_inventory_id' => null,
                'type' => 'IN',
                'quantity' => 38,
                'is_transfer' => false,
                'created_at' => $today
            ],
            [
                'inventory_id' => 1,
                'ref_inventory_id' => null,
                'type' => 'IN',
                'quantity' => 8,
                'is_transfer' => false,
                'created_at' => $today
            ],
            [
                'inventory_id' => 2,
                'ref_inventory_id' => null,
                'type' => 'IN',
                'quantity' => 6,
                'is_transfer' => false,
                'created_at' => $today
            ],
            [
                'inventory_id' => 3,
                'ref_inventory_id' => null,
                'type' => 'IN',
                'quantity' => 12,
                'is_transfer' => false,
                'created_at' => $today
            ]
        ]);
    }
}

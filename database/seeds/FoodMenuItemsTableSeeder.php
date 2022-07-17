<?php

use Illuminate\Database\Seeder;

class FoodMenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('food_menu_items')->delete();
        
        \DB::table('food_menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'food_menu_id' => 1,
                'raw_material_id' => 4,
                'created_at' => '2020-05-17 16:46:56',
                'updated_at' => '2020-05-17 16:46:56',
            ),
            1 => 
            array (
                'id' => 2,
                'food_menu_id' => 1,
                'raw_material_id' => 6,
                'created_at' => '2020-05-17 16:46:56',
                'updated_at' => '2020-05-17 16:46:56',
            ),
            2 => 
            array (
                'id' => 3,
                'food_menu_id' => 2,
                'raw_material_id' => 2,
                'created_at' => '2020-05-17 16:47:32',
                'updated_at' => '2020-05-17 16:47:32',
            ),
            3 => 
            array (
                'id' => 4,
                'food_menu_id' => 2,
                'raw_material_id' => 8,
                'created_at' => '2020-05-17 16:47:32',
                'updated_at' => '2020-05-17 16:47:32',
            ),
        ));
        
        
    }
}
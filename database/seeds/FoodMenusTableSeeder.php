<?php

use Illuminate\Database\Seeder;

class FoodMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('food_menus')->delete();
        
        \DB::table('food_menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'bn_name' => 'সকালের নাস্তা',
                'en_name' => 'Breakfast',
                'remark' => NULL,
                'created_at' => '2020-05-17 16:46:56',
                'updated_at' => '2020-05-17 16:46:56',
            ),
            1 => 
            array (
                'id' => 2,
                'bn_name' => 'দুপুরের খাবার',
                'en_name' => 'Lunch',
                'remark' => NULL,
                'created_at' => '2020-05-17 16:47:32',
                'updated_at' => '2020-05-17 16:47:32',
            ),
        ));
        
        
    }
}
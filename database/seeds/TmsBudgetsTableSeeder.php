<?php

use Illuminate\Database\Seeder;

class TmsBudgetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tms_budgets')->delete();
        
        \DB::table('tms_budgets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'training_id' => 1,
                'budget_source' => 'organization',
                'details' => NULL,
                'status' => 'active',
                'created_at' => '2020-04-29 18:09:54',
                'updated_at' => '2020-04-29 18:09:54',
            ),
            1 => 
            array (
                'id' => 2,
                'training_id' => 2,
                'budget_source' => 'revenue',
                'details' => 'test',
                'status' => 'active',
                'created_at' => '2020-05-05 20:36:01',
                'updated_at' => '2020-05-05 20:36:01',
            ),
            2 => 
            array (
                'id' => 3,
                'training_id' => 10,
                'budget_source' => 'revenue',
                'details' => NULL,
                'status' => 'active',
                'created_at' => '2020-05-18 20:18:11',
                'updated_at' => '2020-05-18 20:18:11',
            ),
        ));
        
        
    }
}
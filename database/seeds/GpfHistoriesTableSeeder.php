<?php

use Illuminate\Database\Seeder;

class GpfHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('gpf_histories')->delete();
        
        \DB::table('gpf_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'employee_id' => 19,
                'percentage' => 10,
                'status' => 1,
                'created_at' => '2019-10-02 12:43:25',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
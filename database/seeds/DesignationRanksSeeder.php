<?php

use Illuminate\Database\Seeder;

class DesignationRanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('designation_ranks')->delete();

        \DB::table('designation_ranks')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'rank' => 'First Class',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'rank' => 'Second Class',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'rank' => 'Third Class',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'rank' => 'Fourth Class',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));
    }
}

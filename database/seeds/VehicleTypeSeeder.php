<?php

use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('vehicle_types')->delete();

        \DB::table('vehicle_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'title_english' => 'Mini Bus',
                    'title_bangla' => 'মিনি বাস',
                    'code' => 'MINIBUS',
                ),
            1 =>
                array(
                    'id' => 2,
                    'title_english' => 'Micro Bus',
                    'title_bangla' => 'মাইক্রো বাস',
                    'code' => 'MICROBUS',
                ),
            2 =>
                array(
                    'id' => 3,
                    'title_english' => 'Jeep',
                    'title_bangla' => 'জীপ',
                    'code' => 'JEEP',
                )
        ));
    }
}

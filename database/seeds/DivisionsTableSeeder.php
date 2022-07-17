<?php

use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('divisions')->delete();

        \DB::table('divisions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Barishal',
                    'bn_name' => 'বরিশাল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Chattogram',
                    'bn_name' => 'চট্টগ্রাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Dhaka',
                    'bn_name' => 'ঢাকা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'Khulna',
                    'bn_name' => 'খুলনা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'Rajshahi',
                    'bn_name' => 'রাজশাহী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'Rangpur',
                    'bn_name' => 'রংপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'Sylhet',
                    'bn_name' => 'সিলেট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'Mymensingh',
                    'bn_name' => 'ময়মনসিংহ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}
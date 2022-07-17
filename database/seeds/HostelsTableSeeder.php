<?php

use Illuminate\Database\Seeder;

class HostelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('hostels')->delete();

        \DB::table('hostels')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'বীরশ্রেষ্ঠ শহীদ মহিউদ্দিন জাহাঙ্গীর',
                    'total_floor' => 3,
                    'created_at' => '2019-02-07 21:30:05',
                    'updated_at' => '2019-02-07 21:30:05',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'বীরশ্রেষ্ঠ শহীদ হামিদুর রহমান',
                    'total_floor' => 3,
                    'created_at' => '2019-02-07 21:30:05',
                    'updated_at' => '2019-02-07 21:30:05',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'বীরশ্রেষ্ঠ শহীদ মোস্তফা কামাল',
                    'total_floor' => 3,
                    'created_at' => '2019-02-07 21:30:05',
                    'updated_at' => '2019-02-07 21:30:05',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'বীরশ্রেষ্ঠ শহীদ মতিউর রহমান',
                    'total_floor' => 3,
                    'created_at' => '2019-02-07 21:30:05',
                    'updated_at' => '2019-02-07 21:30:05',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'বীরশ্রেষ্ঠ শহীদ মোহাম্মদ রুহুল আমিন',
                    'total_floor' => 3,
                    'created_at' => '2019-02-07 21:30:05',
                    'updated_at' => '2019-02-07 21:30:05',
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'বীরশ্রেষ্ঠ শহীদ মুন্সি আব্দুর রউফ',
                    'total_floor' => 3,
                    'created_at' => '2019-02-07 21:30:05',
                    'updated_at' => '2019-02-07 21:30:05',
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'বীরশ্রেষ্ঠ শহীদ নূর মোহাম্মদ শেখ',
                    'total_floor' => 3,
                    'created_at' => '2019-02-07 21:30:06',
                    'updated_at' => '2019-02-07 21:30:06',
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'তিতাস গেস্ট হাউজ',
                    'total_floor' => 1,
                    'created_at' => '2019-02-07 21:30:06',
                    'updated_at' => '2019-02-07 21:30:06',
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'গোমতী গেস্ট হাউজ',
                    'total_floor' => 2,
                    'created_at' => '2019-02-07 21:30:06',
                    'updated_at' => '2019-02-07 21:30:06',
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'বন কুঠির',
                    'total_floor' => 2,
                    'created_at' => '2019-02-07 21:30:06',
                    'updated_at' => '2019-02-07 21:30:06',
                ),
        ));


    }
}
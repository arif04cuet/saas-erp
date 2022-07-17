<?php

use Illuminate\Database\Seeder;

class RoomTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('room_types')->delete();

        \DB::table('room_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'এসি সিঙ্গেল রুম (হোস্টেল )',
                    'capacity' => 2,
                    'government_official_rate' => '400.00',
                    'government_personal_rate' => '900.00',
                    'non_government_rate' => '900.00',
                    'international_rate' => '1500.00',
                    'created_at' => '2019-07-24 00:41:12',
                    'updated_at' => '2019-07-24 00:41:12',
                    'bard_rate' => '200.00',
                    'others_rate' => '200.00',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'এসি সিঙ্গেল রুম (গেস্ট হাউজ  ২)',
                    'capacity' => 4,
                    'government_official_rate' => '700.00',
                    'government_personal_rate' => '1000.00',
                    'non_government_rate' => '1000.00',
                    'international_rate' => '1500.00',
                    'created_at' => '2019-07-24 00:42:05',
                    'updated_at' => '2019-07-24 00:42:05',
                    'bard_rate' => '350.00',
                    'others_rate' => '350.00',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'এসি ডাবল রুম (হোস্টেল )',
                    'capacity' => 2,
                    'government_official_rate' => '800.00',
                    'government_personal_rate' => '1500.00',
                    'non_government_rate' => '1500.00',
                    'international_rate' => '2000.00',
                    'created_at' => '2019-07-24 00:42:58',
                    'updated_at' => '2019-07-24 00:42:58',
                    'bard_rate' => '400.00',
                    'others_rate' => '400.00',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'এসি ডাবল রুম (গেস্ট হাউজ  ১)',
                    'capacity' => 5,
                    'government_official_rate' => '300.00',
                    'government_personal_rate' => '2000.00',
                    'non_government_rate' => '2000.00',
                    'international_rate' => '2500.00',
                    'created_at' => '2019-07-24 00:44:01',
                    'updated_at' => '2019-07-24 00:44:01',
                    'bard_rate' => '150.00',
                    'others_rate' => '150.00',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'এসি ডাবল রুম (গেস্ট হাউজ  ২)',
                    'capacity' => 5,
                    'government_official_rate' => '800.00',
                    'government_personal_rate' => '1500.00',
                    'non_government_rate' => '1500.00',
                    'international_rate' => '2000.00',
                    'created_at' => '2019-07-24 00:44:58',
                    'updated_at' => '2019-07-24 00:44:58',
                    'bard_rate' => '400.00',
                    'others_rate' => '400.00',
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'এসি ডিলাক্স রুম',
                    'capacity' => 4,
                    'government_official_rate' => '800.00',
                    'government_personal_rate' => '1800.00',
                    'non_government_rate' => '1800.00',
                    'international_rate' => '2200.00',
                    'created_at' => '2019-07-24 00:45:59',
                    'updated_at' => '2019-07-24 00:45:59',
                    'bard_rate' => '400.00',
                    'others_rate' => '400.00',
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'নন এসি সিঙ্গেল রুম',
                    'capacity' => 1,
                    'government_official_rate' => '200.00',
                    'government_personal_rate' => '500.00',
                    'non_government_rate' => '500.00',
                    'international_rate' => '1000.00',
                    'created_at' => '2019-07-24 00:49:42',
                    'updated_at' => '2019-07-24 00:49:42',
                    'bard_rate' => '100.00',
                    'others_rate' => '100.00',
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'এসি মাস্টার বেড',
                    'capacity' => 2,
                    'government_official_rate' => '1000.00',
                    'government_personal_rate' => '2200.00',
                    'non_government_rate' => '2200.00',
                    'international_rate' => '2500.00',
                    'created_at' => '2019-07-24 00:51:58',
                    'updated_at' => '2019-07-24 00:51:58',
                    'bard_rate' => '500.00',
                    'others_rate' => '500.00',
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'প্রতি ফ্ল্যাট',
                    'capacity' => 4,
                    'government_official_rate' => '1200.00',
                    'government_personal_rate' => '2000.00',
                    'non_government_rate' => '2000.00',
                    'international_rate' => '3000.00',
                    'created_at' => '2019-07-24 00:52:38',
                    'updated_at' => '2019-07-24 00:52:38',
                    'bard_rate' => '600.00',
                    'others_rate' => '600.00',
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'ডাবল কক্ষ',
                    'capacity' => 4,
                    'government_official_rate' => '500.00',
                    'government_personal_rate' => '800.00',
                    'non_government_rate' => '800.00',
                    'international_rate' => '1500.00',
                    'created_at' => '2019-07-24 00:53:19',
                    'updated_at' => '2019-07-24 00:53:19',
                    'bard_rate' => '250.00',
                    'others_rate' => '250.00',
                ),
        ));

    }
}
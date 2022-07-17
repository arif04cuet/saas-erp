<?php

use Illuminate\Database\Seeder;

class InventoryCategoryGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('inventory_category_groups')->delete();
        
        \DB::table('inventory_category_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Distemper',
                'name_bn' => 'ডিসটেম্পার',
                'created_at' => '2020-06-14 21:33:54',
                'updated_at' => '2020-06-14 21:34:16',
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Cement',
                'name_bn' => 'সিমেন্ট',
                'created_at' => '2020-06-14 21:34:41',
                'updated_at' => '2020-06-14 21:34:41',
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Enamel paint',
                'name_bn' => 'এনামলে পেইন্ট',
                'created_at' => '2020-06-14 21:35:41',
                'updated_at' => '2020-06-14 21:35:41',
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'W/C sealer',
                'name_bn' => 'W/C সিলার',
                'created_at' => '2020-06-14 21:36:17',
                'updated_at' => '2020-06-14 21:36:17',
            ),
            4 => 
            array (
                'id' => 5,
                'name_en' => 'Inner Seeler',
                'name_bn' => 'ইনার সিলার',
                'created_at' => '2020-06-14 21:36:43',
                'updated_at' => '2020-06-14 21:36:43',
            ),
            5 => 
            array (
                'id' => 6,
                'name_en' => 'Iron head',
                'name_bn' => 'লোহার শিরিষ',
                'created_at' => '2020-06-14 21:37:19',
                'updated_at' => '2020-06-14 21:37:19',
            ),
            6 => 
            array (
                'id' => 7,
                'name_en' => 'Brush',
                'name_bn' => 'ব্রাশ',
                'created_at' => '2020-06-14 21:57:40',
                'updated_at' => '2020-06-14 21:57:40',
            ),
            7 => 
            array (
                'id' => 8,
                'name_en' => 'Hammer',
                'name_bn' => 'হাতুড়ী',
                'created_at' => '2020-06-14 21:58:31',
                'updated_at' => '2020-06-14 21:58:31',
            ),
            8 => 
            array (
                'id' => 9,
                'name_en' => 'Chitkini',
                'name_bn' => 'সিটকিনি',
                'created_at' => '2020-06-14 22:00:56',
                'updated_at' => '2020-06-14 22:00:56',
            ),
            9 => 
            array (
                'id' => 10,
                'name_en' => 'Bucket',
                'name_bn' => 'বালতি',
                'created_at' => '2020-06-14 22:01:10',
                'updated_at' => '2020-06-14 22:01:10',
            ),
            10 => 
            array (
                'id' => 11,
                'name_en' => 'Sutali',
                'name_bn' => 'সুতলি',
                'created_at' => '2020-06-14 22:01:38',
                'updated_at' => '2020-06-14 22:01:38',
            ),
            11 => 
            array (
                'id' => 12,
                'name_en' => 'Spade',
                'name_bn' => 'কোদাল',
                'created_at' => '2020-06-14 22:02:15',
                'updated_at' => '2020-06-14 22:02:15',
            ),
            12 => 
            array (
                'id' => 13,
                'name_en' => 'Whistle pipe',
                'name_bn' => 'হুইস পাইপ',
                'created_at' => '2020-06-14 22:02:56',
                'updated_at' => '2020-06-14 22:02:56',
            ),
            13 => 
            array (
                'id' => 14,
                'name_en' => 'কম্পিউটার',
                'name_bn' => 'Computer',
                'created_at' => '2020-06-14 22:03:39',
                'updated_at' => '2020-06-14 22:03:39',
            ),
            14 => 
            array (
                'id' => 15,
                'name_en' => 'Duster',
                'name_bn' => 'ডাষ্টার',
                'created_at' => '2020-06-14 22:03:56',
                'updated_at' => '2020-06-14 22:03:56',
            ),
            15 => 
            array (
                'id' => 16,
                'name_en' => 'Tester',
                'name_bn' => 'টেষ্টার',
                'created_at' => '2020-06-14 22:04:21',
                'updated_at' => '2020-06-14 22:04:21',
            ),
            16 => 
            array (
                'id' => 17,
                'name_en' => 'Light',
                'name_bn' => 'লাইট',
                'created_at' => '2020-06-14 22:04:38',
                'updated_at' => '2020-06-14 22:04:38',
            ),
            17 => 
            array (
                'id' => 18,
                'name_en' => 'Thiner',
                'name_bn' => 'থিনার',
                'created_at' => '2020-06-14 22:08:31',
                'updated_at' => '2020-06-14 22:08:31',
            ),
            18 => 
            array (
                'id' => 19,
                'name_en' => 'Glass',
                'name_bn' => 'গ্লাস',
                'created_at' => '2020-06-14 22:13:29',
                'updated_at' => '2020-06-14 22:14:20',
            ),
            19 => 
            array (
                'id' => 20,
                'name_en' => 'Light',
                'name_bn' => 'বাল্ব',
                'created_at' => '2020-06-14 22:16:30',
                'updated_at' => '2020-06-14 22:16:30',
            ),
        ));
        
        
    }
}
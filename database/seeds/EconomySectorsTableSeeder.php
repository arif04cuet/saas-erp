<?php

use Illuminate\Database\Seeder;

class EconomySectorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('economy_sectors')->delete();
        
        \DB::table('economy_sectors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 311133801,
                'parent_economy_code' => 3111338,
                'title' => 'Honorium allowance',
                'title_bangla' => 'সন্মানী ভাতা',
                'description' => NULL,
                'created_at' => '2020-02-20 17:47:05',
                'updated_at' => '2020-02-23 13:10:29',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 311133802,
                'parent_economy_code' => 3111338,
                'title' => 'Special allowance',
                'title_bangla' => 'বিশেষ ভাতা',
                'description' => NULL,
                'created_at' => '2020-02-20 17:47:40',
                'updated_at' => '2020-02-20 17:47:40',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 311133803,
                'parent_economy_code' => 3111338,
                'title' => 'Overtime allowance',
                'title_bangla' => 'অধিকাল ভাতা',
                'description' => NULL,
                'created_at' => '2020-02-20 17:48:13',
                'updated_at' => '2020-02-20 17:48:13',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 325510501,
                'parent_economy_code' => 3255105,
                'title' => 'Fancy Goods',
                'title_bangla' => 'মনিহারি দ্রব্যাদি',
                'description' => NULL,
                'created_at' => '2020-02-20 17:48:48',
                'updated_at' => '2020-02-20 17:48:48',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 325510502,
                'parent_economy_code' => 3255105,
                'title' => 'Furniture',
                'title_bangla' => 'আসবাবপত্র',
                'description' => NULL,
                'created_at' => '2020-02-20 17:49:17',
                'updated_at' => '2020-02-20 17:49:17',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 325510503,
                'parent_economy_code' => 3255105,
                'title' => 'Office Equipment',
                'title_bangla' => 'অফিস সরঞ্জামাদি',
                'description' => NULL,
                'created_at' => '2020-02-20 17:49:50',
                'updated_at' => '2020-02-20 17:49:50',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 325710301,
                'parent_economy_code' => 3257103,
                'title' => 'Fancy Goods collected material and incidental expenses for conducting the research of the Academy',
                'title_bangla' => 'একাডেমীর গবেষণা পরিচালনার জন্য মনিহারি মালামাল সংগ্রহ ও আনুষঙ্গিক ব্যয়',
                'description' => NULL,
                'created_at' => '2020-02-20 17:51:34',
                'updated_at' => '2020-02-20 17:51:34',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 325710302,
                'parent_economy_code' => 3257103,
                'title' => 'The cost of different research-based studies undertaken on long-term initiatives',
                'title_bangla' => 'দীর্ঘ মেয়াদী উদ্যোগে গৃহীত ভিন্ন ভিন্ন গবেষণা ভিত্তিক সমীক্ষা ব্যয়',
                'description' => NULL,
                'created_at' => '2020-02-20 17:53:13',
                'updated_at' => '2020-02-20 17:53:13',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 325710303,
                'parent_economy_code' => 3257103,
                'title' => 'To provide research studies and feasibility studies, higher education and fellowships',
                'title_bangla' => 'গবেষণা সমীক্ষা ও সম্ভাব্যতা যাচাই, উচ্চশিক্ষা ও ফেলোশীপ প্রদান',
                'description' => NULL,
                'created_at' => '2020-02-20 17:54:29',
                'updated_at' => '2020-02-20 17:54:29',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 323130101,
                'parent_economy_code' => 3231301,
            'title' => 'Expenditure on Innovation, Training, Training of Employees and Development of Professional Standards (including Foreign Training)',
            'title_bangla' => 'ইনভেশন, প্রশিক্ষণ, কর্মচারীদের প্রশিক্ষণ ও পেশাগত মান উন্নয়ন ব্যয় ( বৈদেশিক প্রশিক্ষণ সহ)',
                'description' => NULL,
                'created_at' => '2020-02-20 17:55:55',
                'updated_at' => '2020-02-20 17:55:55',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 323130102,
                'parent_economy_code' => 3231301,
                'title' => 'Collection of audio visuals, computers, training equipment, repairs and furniture',
                'title_bangla' => 'অডিও ভিস্যুয়াল, কম্পিউটার, প্রশিক্ষণ যন্ত্রপাতি, মেরামত ব্যয় ও আসবাবপত্র সংগ্রহ',
                'description' => NULL,
                'created_at' => '2020-02-20 17:57:01',
                'updated_at' => '2020-02-20 17:57:01',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 323130103,
                'parent_economy_code' => 3231301,
                'title' => 'Yearbook, course brochure, credentials, printing other booklet folders',
                'title_bangla' => 'বর্ষপুঞ্জী, কোর্স ব্রশিউর, প্রত্য়য়নপত্র, অন্যান্য পুস্তিকা ফোল্ডার ছাপান ব্যয়',
                'description' => NULL,
                'created_at' => '2020-02-20 17:58:53',
                'updated_at' => '2020-02-20 17:58:53',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 321111101,
                'parent_economy_code' => 3211111,
                'title' => 'Meetings, seminars, conferences / founding anniversaries / national important days',
                'title_bangla' => 'সভা, সেমিনার, সম্মেলন/ প্রতিষ্ঠা বার্ষিকী/ জাতীয় গুরুত্বপূর্ণ দিবস সমূহ',
                'description' => NULL,
                'created_at' => '2020-02-20 18:15:47',
                'updated_at' => '2020-02-20 18:15:47',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 321111102,
                'parent_economy_code' => 3211111,
            'title' => 'Expenditure on conducting training, seminars, workshops to promote and disseminate research results (Research Highlights)',
            'title_bangla' => 'গবেষণা ফলাফল প্রচা ও প্রসারের জন্য প্রশিক্ষণ, সেমিনার, কর্মশালার আয়োজন ব্যয় (রিসার্চ হাইলাইটস)',
                'description' => NULL,
                'created_at' => '2020-02-20 18:17:02',
                'updated_at' => '2020-02-20 18:17:02',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 325810401,
                'parent_economy_code' => 3258104,
                'title' => 'Water supply system and maintenance',
                'title_bangla' => 'পানি সরবরাহ ব্যবস্থা ও রক্ষনাবেক্ষন',
                'description' => NULL,
                'created_at' => '2020-02-20 18:17:51',
                'updated_at' => '2020-02-20 18:17:51',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 325810402,
                'parent_economy_code' => 3258104,
                'title' => 'Firm development and maintenance',
                'title_bangla' => 'ফার্ম উন্নয়ন ও রক্ষনাবেক্ষন',
                'description' => NULL,
                'created_at' => '2020-02-20 18:18:24',
                'updated_at' => '2020-02-20 18:18:24',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 325810403,
                'parent_economy_code' => 3258104,
                'title' => 'Maintenance of gas supply system',
                'title_bangla' => 'গ্যাস সরবরাহ ব্যবস্থা রক্ষনাবেক্ষন',
                'description' => NULL,
                'created_at' => '2020-02-20 18:19:34',
                'updated_at' => '2020-02-20 18:19:34',
            ),
        ));
        
        
    }
}
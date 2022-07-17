<?php

use Illuminate\Database\Seeder;

class ThanasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('thanas')->delete();

        \DB::table('thanas')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'district_id' => 34,
                    'name' => 'Amtali Upazila',
                    'bn_name' => 'আমতলী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'district_id' => 34,
                    'name' => 'Bamna Upazila',
                    'bn_name' => 'বামনা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'district_id' => 34,
                    'name' => 'Barguna Sadar Upazila',
                    'bn_name' => 'বরগুনা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'district_id' => 34,
                    'name' => 'Betagi Upazila',
                    'bn_name' => 'বেতাগি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'district_id' => 34,
                    'name' => 'Patharghata Upazila',
                    'bn_name' => 'পাথরঘাটা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'district_id' => 34,
                    'name' => 'Taltali Upazila',
                    'bn_name' => 'তালতলী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'district_id' => 35,
                    'name' => 'Muladi Upazila',
                    'bn_name' => 'মুলাদি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'district_id' => 35,
                    'name' => 'Babuganj Upazila',
                    'bn_name' => 'বাবুগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            8 =>
                array(
                    'id' => 9,
                    'district_id' => 35,
                    'name' => 'Agailjhara Upazila',
                    'bn_name' => 'আগাইলঝরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            9 =>
                array(
                    'id' => 10,
                    'district_id' => 35,
                    'name' => 'Barisal Sadar Upazila',
                    'bn_name' => 'বরিশাল সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            10 =>
                array(
                    'id' => 11,
                    'district_id' => 35,
                    'name' => 'Bakerganj Upazila',
                    'bn_name' => 'বাকেরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            11 =>
                array(
                    'id' => 12,
                    'district_id' => 35,
                    'name' => 'Banaripara Upazila',
                    'bn_name' => 'বানাড়িপারা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            12 =>
                array(
                    'id' => 13,
                    'district_id' => 35,
                    'name' => 'Gaurnadi Upazila',
                    'bn_name' => 'গৌরনদী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            13 =>
                array(
                    'id' => 14,
                    'district_id' => 35,
                    'name' => 'Hizla Upazila',
                    'bn_name' => 'হিজলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            14 =>
                array(
                    'id' => 15,
                    'district_id' => 35,
                    'name' => 'Mehendiganj Upazila',
                    'bn_name' => 'মেহেদিগঞ্জ ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            15 =>
                array(
                    'id' => 16,
                    'district_id' => 35,
                    'name' => 'Wazirpur Upazila',
                    'bn_name' => 'ওয়াজিরপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            16 =>
                array(
                    'id' => 17,
                    'district_id' => 36,
                    'name' => 'Bhola Sadar Upazila',
                    'bn_name' => 'ভোলা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            17 =>
                array(
                    'id' => 18,
                    'district_id' => 36,
                    'name' => 'Burhanuddin Upazila',
                    'bn_name' => 'বুরহানউদ্দিন',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            18 =>
                array(
                    'id' => 19,
                    'district_id' => 36,
                    'name' => 'Char Fasson Upazila',
                    'bn_name' => 'চর ফ্যাশন',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            19 =>
                array(
                    'id' => 20,
                    'district_id' => 36,
                    'name' => 'Daulatkhan Upazila',
                    'bn_name' => 'দৌলতখান',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            20 =>
                array(
                    'id' => 21,
                    'district_id' => 36,
                    'name' => 'Lalmohan Upazila',
                    'bn_name' => 'লালমোহন',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            21 =>
                array(
                    'id' => 22,
                    'district_id' => 36,
                    'name' => 'Manpura Upazila',
                    'bn_name' => 'মনপুরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            22 =>
                array(
                    'id' => 23,
                    'district_id' => 36,
                    'name' => 'Tazumuddin Upazila',
                    'bn_name' => 'তাজুমুদ্দিন',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            23 =>
                array(
                    'id' => 24,
                    'district_id' => 37,
                    'name' => 'Jhalokati Sadar Upazila',
                    'bn_name' => 'ঝালকাঠি সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            24 =>
                array(
                    'id' => 25,
                    'district_id' => 37,
                    'name' => 'Kathalia Upazila',
                    'bn_name' => 'কাঁঠালিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            25 =>
                array(
                    'id' => 26,
                    'district_id' => 37,
                    'name' => 'Nalchity Upazila',
                    'bn_name' => 'নালচিতি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            26 =>
                array(
                    'id' => 27,
                    'district_id' => 37,
                    'name' => 'Rajapur Upazila',
                    'bn_name' => 'রাজাপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            27 =>
                array(
                    'id' => 28,
                    'district_id' => 38,
                    'name' => 'Bauphal Upazila',
                    'bn_name' => 'বাউফল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            28 =>
                array(
                    'id' => 29,
                    'district_id' => 38,
                    'name' => 'Dashmina Upazila',
                    'bn_name' => 'দশমিনা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            29 =>
                array(
                    'id' => 30,
                    'district_id' => 38,
                    'name' => 'Galachipa Upazila',
                    'bn_name' => 'গলাচিপা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            30 =>
                array(
                    'id' => 31,
                    'district_id' => 38,
                    'name' => 'Kalapara Upazila',
                    'bn_name' => 'কালাপারা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            31 =>
                array(
                    'id' => 32,
                    'district_id' => 38,
                    'name' => 'Mirzaganj Upazila',
                    'bn_name' => 'মির্জাগঞ্জ ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            32 =>
                array(
                    'id' => 33,
                    'district_id' => 38,
                    'name' => 'Patuakhali Sadar Upazila',
                    'bn_name' => 'পটুয়াখালী সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            33 =>
                array(
                    'id' => 34,
                    'district_id' => 38,
                    'name' => 'Dumki Upazila',
                    'bn_name' => 'ডুমকি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            34 =>
                array(
                    'id' => 35,
                    'district_id' => 38,
                    'name' => 'Rangabali Upazila',
                    'bn_name' => 'রাঙ্গাবালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            35 =>
                array(
                    'id' => 36,
                    'district_id' => 39,
                    'name' => 'Bhandaria',
                    'bn_name' => 'ভ্যান্ডারিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            36 =>
                array(
                    'id' => 37,
                    'district_id' => 39,
                    'name' => 'Kaukhali',
                    'bn_name' => 'কাউখালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            37 =>
                array(
                    'id' => 38,
                    'district_id' => 39,
                    'name' => 'Mathbaria',
                    'bn_name' => 'মাঠবাড়িয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            38 =>
                array(
                    'id' => 39,
                    'district_id' => 39,
                    'name' => 'Nazirpur',
                    'bn_name' => 'নাজিরপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            39 =>
                array(
                    'id' => 40,
                    'district_id' => 39,
                    'name' => 'Nesarabad',
                    'bn_name' => 'নেসারাবাদ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            40 =>
                array(
                    'id' => 41,
                    'district_id' => 39,
                    'name' => 'Pirojpur Sadar',
                    'bn_name' => 'পিরোজপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            41 =>
                array(
                    'id' => 42,
                    'district_id' => 39,
                    'name' => 'Zianagar',
                    'bn_name' => 'জিয়ানগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            42 =>
                array(
                    'id' => 43,
                    'district_id' => 40,
                    'name' => 'Bandarban Sadar',
                    'bn_name' => 'বান্দরবন সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            43 =>
                array(
                    'id' => 44,
                    'district_id' => 40,
                    'name' => 'Thanchi',
                    'bn_name' => 'থানচি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            44 =>
                array(
                    'id' => 45,
                    'district_id' => 40,
                    'name' => 'Lama',
                    'bn_name' => 'লামা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            45 =>
                array(
                    'id' => 46,
                    'district_id' => 40,
                    'name' => 'Naikhongchhari',
                    'bn_name' => 'নাইখংছড়ি ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            46 =>
                array(
                    'id' => 47,
                    'district_id' => 40,
                    'name' => 'Ali kadam',
                    'bn_name' => 'আলী কদম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            47 =>
                array(
                    'id' => 48,
                    'district_id' => 40,
                    'name' => 'Rowangchhari',
                    'bn_name' => 'রউয়াংছড়ি ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            48 =>
                array(
                    'id' => 49,
                    'district_id' => 40,
                    'name' => 'Ruma',
                    'bn_name' => 'রুমা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            49 =>
                array(
                    'id' => 50,
                    'district_id' => 41,
                    'name' => 'Brahmanbaria Sadar Upazila',
                    'bn_name' => 'ব্রাহ্মণবাড়িয়া সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            50 =>
                array(
                    'id' => 51,
                    'district_id' => 41,
                    'name' => 'Ashuganj Upazila',
                    'bn_name' => 'আশুগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            51 =>
                array(
                    'id' => 52,
                    'district_id' => 41,
                    'name' => 'Nasirnagar Upazila',
                    'bn_name' => 'নাসির নগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            52 =>
                array(
                    'id' => 53,
                    'district_id' => 41,
                    'name' => 'Nabinagar Upazila',
                    'bn_name' => 'নবীনগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            53 =>
                array(
                    'id' => 54,
                    'district_id' => 41,
                    'name' => 'Sarail Upazila',
                    'bn_name' => 'সরাইল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            54 =>
                array(
                    'id' => 55,
                    'district_id' => 41,
                    'name' => 'Shahbazpur Town',
                    'bn_name' => 'শাহবাজপুর টাউন',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            55 =>
                array(
                    'id' => 56,
                    'district_id' => 41,
                    'name' => 'Kasba Upazila',
                    'bn_name' => 'কসবা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            56 =>
                array(
                    'id' => 57,
                    'district_id' => 41,
                    'name' => 'Akhaura Upazila',
                    'bn_name' => 'আখাউরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            57 =>
                array(
                    'id' => 58,
                    'district_id' => 41,
                    'name' => 'Bancharampur Upazila',
                    'bn_name' => 'বাঞ্ছারামপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            58 =>
                array(
                    'id' => 59,
                    'district_id' => 41,
                    'name' => 'Bijoynagar Upazila',
                    'bn_name' => 'বিজয় নগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            59 =>
                array(
                    'id' => 60,
                    'district_id' => 42,
                    'name' => 'Chandpur Sadar',
                    'bn_name' => 'চাঁদপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            60 =>
                array(
                    'id' => 61,
                    'district_id' => 42,
                    'name' => 'Faridganj',
                    'bn_name' => 'ফরিদগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            61 =>
                array(
                    'id' => 62,
                    'district_id' => 42,
                    'name' => 'Haimchar',
                    'bn_name' => 'হাইমচর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            62 =>
                array(
                    'id' => 63,
                    'district_id' => 42,
                    'name' => 'Haziganj',
                    'bn_name' => 'হাজীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            63 =>
                array(
                    'id' => 64,
                    'district_id' => 42,
                    'name' => 'Kachua',
                    'bn_name' => 'কচুয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            64 =>
                array(
                    'id' => 65,
                    'district_id' => 42,
                    'name' => 'Matlab Uttar',
                    'bn_name' => 'মতলব উত্তর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            65 =>
                array(
                    'id' => 66,
                    'district_id' => 42,
                    'name' => 'Matlab Dakkhin',
                    'bn_name' => 'মতলব দক্ষিণ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            66 =>
                array(
                    'id' => 67,
                    'district_id' => 42,
                    'name' => 'Shahrasti',
                    'bn_name' => 'শাহরাস্তি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            67 =>
                array(
                    'id' => 68,
                    'district_id' => 43,
                    'name' => 'Anwara Upazila',
                    'bn_name' => 'আনোয়ারা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            68 =>
                array(
                    'id' => 69,
                    'district_id' => 43,
                    'name' => 'Banshkhali Upazila',
                    'bn_name' => 'বাশখালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            69 =>
                array(
                    'id' => 70,
                    'district_id' => 43,
                    'name' => 'Boalkhali Upazila',
                    'bn_name' => 'বোয়ালখালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            70 =>
                array(
                    'id' => 71,
                    'district_id' => 43,
                    'name' => 'Chandanaish Upazila',
                    'bn_name' => 'চন্দনাইশ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            71 =>
                array(
                    'id' => 72,
                    'district_id' => 43,
                    'name' => 'Fatikchhari Upazila',
                    'bn_name' => 'ফটিকছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            72 =>
                array(
                    'id' => 73,
                    'district_id' => 43,
                    'name' => 'Hathazari Upazila',
                    'bn_name' => 'হাঠহাজারী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            73 =>
                array(
                    'id' => 74,
                    'district_id' => 43,
                    'name' => 'Lohagara Upazila',
                    'bn_name' => 'লোহাগারা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            74 =>
                array(
                    'id' => 75,
                    'district_id' => 43,
                    'name' => 'Mirsharai Upazila',
                    'bn_name' => 'মিরসরাই',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            75 =>
                array(
                    'id' => 76,
                    'district_id' => 43,
                    'name' => 'Patiya Upazila',
                    'bn_name' => 'পটিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            76 =>
                array(
                    'id' => 77,
                    'district_id' => 43,
                    'name' => 'Rangunia Upazila',
                    'bn_name' => 'রাঙ্গুনিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            77 =>
                array(
                    'id' => 78,
                    'district_id' => 43,
                    'name' => 'Raozan Upazila',
                    'bn_name' => 'রাউজান',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            78 =>
                array(
                    'id' => 79,
                    'district_id' => 43,
                    'name' => 'Sandwip Upazila',
                    'bn_name' => 'সন্দ্বীপ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            79 =>
                array(
                    'id' => 80,
                    'district_id' => 43,
                    'name' => 'Satkania Upazila',
                    'bn_name' => 'সাতকানিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            80 =>
                array(
                    'id' => 81,
                    'district_id' => 43,
                    'name' => 'Sitakunda Upazila',
                    'bn_name' => 'সীতাকুণ্ড',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            81 =>
                array(
                    'id' => 82,
                    'district_id' => 44,
                    'name' => 'Barura Upazila',
                    'bn_name' => 'বড়ুরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            82 =>
                array(
                    'id' => 83,
                    'district_id' => 44,
                    'name' => 'Brahmanpara Upazila',
                    'bn_name' => 'ব্রাহ্মণপাড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            83 =>
                array(
                    'id' => 84,
                    'district_id' => 44,
                    'name' => 'Burichong Upazila',
                    'bn_name' => 'বুড়িচং',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            84 =>
                array(
                    'id' => 85,
                    'district_id' => 44,
                    'name' => 'Chandina Upazila',
                    'bn_name' => 'চান্দিনা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            85 =>
                array(
                    'id' => 86,
                    'district_id' => 44,
                    'name' => 'Chauddagram Upazila',
                    'bn_name' => 'চৌদ্দগ্রাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            86 =>
                array(
                    'id' => 87,
                    'district_id' => 44,
                    'name' => 'Daudkandi Upazila',
                    'bn_name' => 'দাউদকান্দি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            87 =>
                array(
                    'id' => 88,
                    'district_id' => 44,
                    'name' => 'Debidwar Upazila',
                    'bn_name' => 'দেবীদ্বার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            88 =>
                array(
                    'id' => 89,
                    'district_id' => 44,
                    'name' => 'Homna Upazila',
                    'bn_name' => 'হোমনা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            89 =>
                array(
                    'id' => 90,
                    'district_id' => 44,
                    'name' => 'Comilla Sadar Upazila',
                    'bn_name' => 'কুমিল্লা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            90 =>
                array(
                    'id' => 91,
                    'district_id' => 44,
                    'name' => 'Laksam Upazila',
                    'bn_name' => 'লাকসাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            91 =>
                array(
                    'id' => 92,
                    'district_id' => 44,
                    'name' => 'Monohorgonj Upazila',
                    'bn_name' => 'মনোহরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            92 =>
                array(
                    'id' => 93,
                    'district_id' => 44,
                    'name' => 'Meghna Upazila',
                    'bn_name' => 'মেঘনা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            93 =>
                array(
                    'id' => 94,
                    'district_id' => 44,
                    'name' => 'Muradnagar Upazila',
                    'bn_name' => 'মুরাদনগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            94 =>
                array(
                    'id' => 95,
                    'district_id' => 44,
                    'name' => 'Nangalkot Upazila',
                    'bn_name' => 'নাঙ্গালকোট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            95 =>
                array(
                    'id' => 96,
                    'district_id' => 44,
                    'name' => 'Comilla Sadar South Upazila',
                    'bn_name' => 'কুমিল্লা সদর দক্ষিণ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            96 =>
                array(
                    'id' => 97,
                    'district_id' => 44,
                    'name' => 'Titas Upazila',
                    'bn_name' => 'তিতাস',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            97 =>
                array(
                    'id' => 98,
                    'district_id' => 45,
                    'name' => 'Chakaria Upazila',
                    'bn_name' => 'চকরিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            98 =>
                array(
                    'id' => 100,
                    'district_id' => 45,
                    'name' => 'Cox\'s Bazar Sadar Upazila',
                    'bn_name' => 'কক্স বাজার সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            99 =>
                array(
                    'id' => 101,
                    'district_id' => 45,
                    'name' => 'Kutubdia Upazila',
                    'bn_name' => 'কুতুবদিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            100 =>
                array(
                    'id' => 102,
                    'district_id' => 45,
                    'name' => 'Maheshkhali Upazila',
                    'bn_name' => 'মহেশখালী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            101 =>
                array(
                    'id' => 103,
                    'district_id' => 45,
                    'name' => 'Ramu Upazila',
                    'bn_name' => 'রামু',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            102 =>
                array(
                    'id' => 104,
                    'district_id' => 45,
                    'name' => 'Teknaf Upazila',
                    'bn_name' => 'টেকনাফ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            103 =>
                array(
                    'id' => 105,
                    'district_id' => 45,
                    'name' => 'Ukhia Upazila',
                    'bn_name' => 'উখিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            104 =>
                array(
                    'id' => 106,
                    'district_id' => 45,
                    'name' => 'Pekua Upazila',
                    'bn_name' => 'পেকুয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            105 =>
                array(
                    'id' => 107,
                    'district_id' => 46,
                    'name' => 'Feni Sadar',
                    'bn_name' => 'ফেনী সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            106 =>
                array(
                    'id' => 108,
                    'district_id' => 46,
                    'name' => 'Chagalnaiya',
                    'bn_name' => 'ছাগল নাইয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            107 =>
                array(
                    'id' => 109,
                    'district_id' => 46,
                    'name' => 'Daganbhyan',
                    'bn_name' => 'দাগানভিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            108 =>
                array(
                    'id' => 110,
                    'district_id' => 46,
                    'name' => 'Parshuram',
                    'bn_name' => 'পরশুরাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            109 =>
                array(
                    'id' => 111,
                    'district_id' => 46,
                    'name' => 'Fhulgazi',
                    'bn_name' => 'ফুলগাজি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            110 =>
                array(
                    'id' => 112,
                    'district_id' => 46,
                    'name' => 'Sonagazi',
                    'bn_name' => 'সোনাগাজি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            111 =>
                array(
                    'id' => 113,
                    'district_id' => 47,
                    'name' => 'Dighinala Upazila',
                    'bn_name' => 'দিঘিনালা ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            112 =>
                array(
                    'id' => 114,
                    'district_id' => 47,
                    'name' => 'Khagrachhari Upazila',
                    'bn_name' => 'খাগড়াছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            113 =>
                array(
                    'id' => 115,
                    'district_id' => 47,
                    'name' => 'Lakshmichhari Upazila',
                    'bn_name' => 'লক্ষ্মীছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            114 =>
                array(
                    'id' => 116,
                    'district_id' => 47,
                    'name' => 'Mahalchhari Upazila',
                    'bn_name' => 'মহলছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            115 =>
                array(
                    'id' => 117,
                    'district_id' => 47,
                    'name' => 'Manikchhari Upazila',
                    'bn_name' => 'মানিকছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            116 =>
                array(
                    'id' => 118,
                    'district_id' => 47,
                    'name' => 'Matiranga Upazila',
                    'bn_name' => 'মাটিরাঙ্গা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            117 =>
                array(
                    'id' => 119,
                    'district_id' => 47,
                    'name' => 'Panchhari Upazila',
                    'bn_name' => 'পানছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            118 =>
                array(
                    'id' => 120,
                    'district_id' => 47,
                    'name' => 'Ramgarh Upazila',
                    'bn_name' => 'রামগড়',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            119 =>
                array(
                    'id' => 121,
                    'district_id' => 48,
                    'name' => 'Lakshmipur Sadar Upazila',
                    'bn_name' => 'লক্ষ্মীপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            120 =>
                array(
                    'id' => 122,
                    'district_id' => 48,
                    'name' => 'Raipur Upazila',
                    'bn_name' => 'রায়পুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            121 =>
                array(
                    'id' => 123,
                    'district_id' => 48,
                    'name' => 'Ramganj Upazila',
                    'bn_name' => 'রামগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            122 =>
                array(
                    'id' => 124,
                    'district_id' => 48,
                    'name' => 'Ramgati Upazila',
                    'bn_name' => 'রামগতি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            123 =>
                array(
                    'id' => 125,
                    'district_id' => 48,
                    'name' => 'Komol Nagar Upazila',
                    'bn_name' => 'কমল নগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            124 =>
                array(
                    'id' => 126,
                    'district_id' => 49,
                    'name' => 'Noakhali Sadar Upazila',
                    'bn_name' => 'নোয়াখালী সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            125 =>
                array(
                    'id' => 127,
                    'district_id' => 49,
                    'name' => 'Begumganj Upazila',
                    'bn_name' => 'বেগমগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            126 =>
                array(
                    'id' => 128,
                    'district_id' => 49,
                    'name' => 'Chatkhil Upazila',
                    'bn_name' => 'চাটখিল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            127 =>
                array(
                    'id' => 129,
                    'district_id' => 49,
                    'name' => 'Companyganj Upazila',
                    'bn_name' => 'কোম্পানীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            128 =>
                array(
                    'id' => 130,
                    'district_id' => 49,
                    'name' => 'Shenbag Upazila',
                    'bn_name' => 'শেনবাগ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            129 =>
                array(
                    'id' => 131,
                    'district_id' => 49,
                    'name' => 'Hatia Upazila',
                    'bn_name' => 'হাতিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            130 =>
                array(
                    'id' => 132,
                    'district_id' => 49,
                    'name' => 'Kobirhat Upazila',
                    'bn_name' => 'কবিরহাট ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            131 =>
                array(
                    'id' => 133,
                    'district_id' => 49,
                    'name' => 'Sonaimuri Upazila',
                    'bn_name' => 'সোনাইমুরি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            132 =>
                array(
                    'id' => 134,
                    'district_id' => 49,
                    'name' => 'Suborno Char Upazila',
                    'bn_name' => 'সুবর্ণ চর ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            133 =>
                array(
                    'id' => 135,
                    'district_id' => 50,
                    'name' => 'Rangamati Sadar Upazila',
                    'bn_name' => 'রাঙ্গামাটি সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            134 =>
                array(
                    'id' => 136,
                    'district_id' => 50,
                    'name' => 'Belaichhari Upazila',
                    'bn_name' => 'বেলাইছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            135 =>
                array(
                    'id' => 137,
                    'district_id' => 50,
                    'name' => 'Bagaichhari Upazila',
                    'bn_name' => 'বাঘাইছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            136 =>
                array(
                    'id' => 138,
                    'district_id' => 50,
                    'name' => 'Barkal Upazila',
                    'bn_name' => 'বরকল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            137 =>
                array(
                    'id' => 139,
                    'district_id' => 50,
                    'name' => 'Juraichhari Upazila',
                    'bn_name' => 'জুরাইছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            138 =>
                array(
                    'id' => 140,
                    'district_id' => 50,
                    'name' => 'Rajasthali Upazila',
                    'bn_name' => 'রাজাস্থলি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            139 =>
                array(
                    'id' => 141,
                    'district_id' => 50,
                    'name' => 'Kaptai Upazila',
                    'bn_name' => 'কাপ্তাই',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            140 =>
                array(
                    'id' => 142,
                    'district_id' => 50,
                    'name' => 'Langadu Upazila',
                    'bn_name' => 'লাঙ্গাডু',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            141 =>
                array(
                    'id' => 143,
                    'district_id' => 50,
                    'name' => 'Nannerchar Upazila',
                    'bn_name' => 'নান্নেরচর ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            142 =>
                array(
                    'id' => 144,
                    'district_id' => 50,
                    'name' => 'Kaukhali Upazila',
                    'bn_name' => 'কাউখালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            143 =>
                array(
                    'id' => 145,
                    'district_id' => 1,
                    'name' => 'Dhamrai Upazila',
                    'bn_name' => 'ধামরাই',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            144 =>
                array(
                    'id' => 146,
                    'district_id' => 1,
                    'name' => 'Dohar Upazila',
                    'bn_name' => 'দোহার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            145 =>
                array(
                    'id' => 147,
                    'district_id' => 1,
                    'name' => 'Keraniganj Upazila',
                    'bn_name' => 'কেরানীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            146 =>
                array(
                    'id' => 148,
                    'district_id' => 1,
                    'name' => 'Nawabganj Upazila',
                    'bn_name' => 'নবাবগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            147 =>
                array(
                    'id' => 149,
                    'district_id' => 1,
                    'name' => 'Savar Upazila',
                    'bn_name' => 'সাভার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            148 =>
                array(
                    'id' => 150,
                    'district_id' => 2,
                    'name' => 'Faridpur Sadar Upazila',
                    'bn_name' => 'ফরিদপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            149 =>
                array(
                    'id' => 151,
                    'district_id' => 2,
                    'name' => 'Boalmari Upazila',
                    'bn_name' => 'বোয়ালমারী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            150 =>
                array(
                    'id' => 152,
                    'district_id' => 2,
                    'name' => 'Alfadanga Upazila',
                    'bn_name' => 'আলফাডাঙ্গা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            151 =>
                array(
                    'id' => 153,
                    'district_id' => 2,
                    'name' => 'Madhukhali Upazila',
                    'bn_name' => 'মধুখালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            152 =>
                array(
                    'id' => 154,
                    'district_id' => 2,
                    'name' => 'Bhanga Upazila',
                    'bn_name' => 'ভাঙ্গা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            153 =>
                array(
                    'id' => 155,
                    'district_id' => 2,
                    'name' => 'Nagarkanda Upazila',
                    'bn_name' => 'নগরকান্ড',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            154 =>
                array(
                    'id' => 156,
                    'district_id' => 2,
                    'name' => 'Charbhadrasan Upazila',
                    'bn_name' => 'চরভদ্রাসন ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            155 =>
                array(
                    'id' => 157,
                    'district_id' => 2,
                    'name' => 'Sadarpur Upazila',
                    'bn_name' => 'সদরপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            156 =>
                array(
                    'id' => 158,
                    'district_id' => 2,
                    'name' => 'Shaltha Upazila',
                    'bn_name' => 'শালথা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            157 =>
                array(
                    'id' => 159,
                    'district_id' => 3,
                    'name' => 'Gazipur Sadar-Joydebpur',
                    'bn_name' => 'গাজীপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            158 =>
                array(
                    'id' => 160,
                    'district_id' => 3,
                    'name' => 'Kaliakior',
                    'bn_name' => 'কালিয়াকৈর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            159 =>
                array(
                    'id' => 161,
                    'district_id' => 3,
                    'name' => 'Kapasia',
                    'bn_name' => 'কাপাসিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            160 =>
                array(
                    'id' => 162,
                    'district_id' => 3,
                    'name' => 'Sripur',
                    'bn_name' => 'শ্রীপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            161 =>
                array(
                    'id' => 163,
                    'district_id' => 3,
                    'name' => 'Kaliganj',
                    'bn_name' => 'কালীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            162 =>
                array(
                    'id' => 164,
                    'district_id' => 3,
                    'name' => 'Tongi',
                    'bn_name' => 'টঙ্গি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            163 =>
                array(
                    'id' => 165,
                    'district_id' => 4,
                    'name' => 'Gopalganj Sadar Upazila',
                    'bn_name' => 'গোপালগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            164 =>
                array(
                    'id' => 166,
                    'district_id' => 4,
                    'name' => 'Kashiani Upazila',
                    'bn_name' => 'কাশিয়ানি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            165 =>
                array(
                    'id' => 167,
                    'district_id' => 4,
                    'name' => 'Kotalipara Upazila',
                    'bn_name' => 'কোটালিপাড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            166 =>
                array(
                    'id' => 168,
                    'district_id' => 4,
                    'name' => 'Muksudpur Upazila',
                    'bn_name' => 'মুকসুদপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            167 =>
                array(
                    'id' => 169,
                    'district_id' => 4,
                    'name' => 'Tungipara Upazila',
                    'bn_name' => 'টুঙ্গিপাড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            168 =>
                array(
                    'id' => 170,
                    'district_id' => 5,
                    'name' => 'Dewanganj Upazila',
                    'bn_name' => 'দেওয়ানগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            169 =>
                array(
                    'id' => 171,
                    'district_id' => 5,
                    'name' => 'Baksiganj Upazila',
                    'bn_name' => 'বকসিগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            170 =>
                array(
                    'id' => 172,
                    'district_id' => 5,
                    'name' => 'Islampur Upazila',
                    'bn_name' => 'ইসলামপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            171 =>
                array(
                    'id' => 173,
                    'district_id' => 5,
                    'name' => 'Jamalpur Sadar Upazila',
                    'bn_name' => 'জামালপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            172 =>
                array(
                    'id' => 174,
                    'district_id' => 5,
                    'name' => 'Madarganj Upazila',
                    'bn_name' => 'মাদারগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            173 =>
                array(
                    'id' => 175,
                    'district_id' => 5,
                    'name' => 'Melandaha Upazila',
                    'bn_name' => 'মেলানদাহা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            174 =>
                array(
                    'id' => 176,
                    'district_id' => 5,
                    'name' => 'Sarishabari Upazila',
                    'bn_name' => 'সরিষাবাড়ি ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            175 =>
                array(
                    'id' => 177,
                    'district_id' => 5,
                    'name' => 'Narundi Police I.C',
                    'bn_name' => 'নারুন্দি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            176 =>
                array(
                    'id' => 178,
                    'district_id' => 6,
                    'name' => 'Astagram Upazila',
                    'bn_name' => 'অষ্টগ্রাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            177 =>
                array(
                    'id' => 179,
                    'district_id' => 6,
                    'name' => 'Bajitpur Upazila',
                    'bn_name' => 'বাজিতপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            178 =>
                array(
                    'id' => 180,
                    'district_id' => 6,
                    'name' => 'Bhairab Upazila',
                    'bn_name' => 'ভৈরব',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            179 =>
                array(
                    'id' => 181,
                    'district_id' => 6,
                    'name' => 'Hossainpur Upazila',
                    'bn_name' => 'হোসেনপুর ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            180 =>
                array(
                    'id' => 182,
                    'district_id' => 6,
                    'name' => 'Itna Upazila',
                    'bn_name' => 'ইটনা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            181 =>
                array(
                    'id' => 183,
                    'district_id' => 6,
                    'name' => 'Karimganj Upazila',
                    'bn_name' => 'করিমগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            182 =>
                array(
                    'id' => 184,
                    'district_id' => 6,
                    'name' => 'Katiadi Upazila',
                    'bn_name' => 'কতিয়াদি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            183 =>
                array(
                    'id' => 185,
                    'district_id' => 6,
                    'name' => 'Kishoreganj Sadar Upazila',
                    'bn_name' => 'কিশোরগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            184 =>
                array(
                    'id' => 186,
                    'district_id' => 6,
                    'name' => 'Kuliarchar Upazila',
                    'bn_name' => 'কুলিয়ারচর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            185 =>
                array(
                    'id' => 187,
                    'district_id' => 6,
                    'name' => 'Mithamain Upazila',
                    'bn_name' => 'মিঠামাইন',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            186 =>
                array(
                    'id' => 188,
                    'district_id' => 6,
                    'name' => 'Nikli Upazila',
                    'bn_name' => 'নিকলি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            187 =>
                array(
                    'id' => 189,
                    'district_id' => 6,
                    'name' => 'Pakundia Upazila',
                    'bn_name' => 'পাকুন্ডা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            188 =>
                array(
                    'id' => 190,
                    'district_id' => 6,
                    'name' => 'Tarail Upazila',
                    'bn_name' => 'তাড়াইল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            189 =>
                array(
                    'id' => 191,
                    'district_id' => 7,
                    'name' => 'Madaripur Sadar',
                    'bn_name' => 'মাদারীপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            190 =>
                array(
                    'id' => 192,
                    'district_id' => 7,
                    'name' => 'Kalkini',
                    'bn_name' => 'কালকিনি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            191 =>
                array(
                    'id' => 193,
                    'district_id' => 7,
                    'name' => 'Rajoir',
                    'bn_name' => 'রাজইর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            192 =>
                array(
                    'id' => 194,
                    'district_id' => 7,
                    'name' => 'Shibchar',
                    'bn_name' => 'শিবচর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            193 =>
                array(
                    'id' => 195,
                    'district_id' => 8,
                    'name' => 'Manikganj Sadar Upazila',
                    'bn_name' => 'মানিকগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            194 =>
                array(
                    'id' => 196,
                    'district_id' => 8,
                    'name' => 'Singair Upazila',
                    'bn_name' => 'সিঙ্গাইর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            195 =>
                array(
                    'id' => 197,
                    'district_id' => 8,
                    'name' => 'Shibalaya Upazila',
                    'bn_name' => 'শিবালয়',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            196 =>
                array(
                    'id' => 198,
                    'district_id' => 8,
                    'name' => 'Saturia Upazila',
                    'bn_name' => 'সাঠুরিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            197 =>
                array(
                    'id' => 199,
                    'district_id' => 8,
                    'name' => 'Harirampur Upazila',
                    'bn_name' => 'হরিরামপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            198 =>
                array(
                    'id' => 200,
                    'district_id' => 8,
                    'name' => 'Ghior Upazila',
                    'bn_name' => 'ঘিওর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            199 =>
                array(
                    'id' => 201,
                    'district_id' => 8,
                    'name' => 'Daulatpur Upazila',
                    'bn_name' => 'দৌলতপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            200 =>
                array(
                    'id' => 202,
                    'district_id' => 9,
                    'name' => 'Lohajang Upazila',
                    'bn_name' => 'লোহাজং',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            201 =>
                array(
                    'id' => 203,
                    'district_id' => 9,
                    'name' => 'Sreenagar Upazila',
                    'bn_name' => 'শ্রীনগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            202 =>
                array(
                    'id' => 204,
                    'district_id' => 9,
                    'name' => 'Munshiganj Sadar Upazila',
                    'bn_name' => 'মুন্সিগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            203 =>
                array(
                    'id' => 205,
                    'district_id' => 9,
                    'name' => 'Sirajdikhan Upazila',
                    'bn_name' => 'সিরাজদিখান',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            204 =>
                array(
                    'id' => 206,
                    'district_id' => 9,
                    'name' => 'Tongibari Upazila',
                    'bn_name' => 'টঙ্গিবাড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            205 =>
                array(
                    'id' => 207,
                    'district_id' => 9,
                    'name' => 'Gazaria Upazila',
                    'bn_name' => 'গজারিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            206 =>
                array(
                    'id' => 208,
                    'district_id' => 10,
                    'name' => 'Bhaluka',
                    'bn_name' => 'ভালুকা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            207 =>
                array(
                    'id' => 209,
                    'district_id' => 10,
                    'name' => 'Trishal',
                    'bn_name' => 'ত্রিশাল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            208 =>
                array(
                    'id' => 210,
                    'district_id' => 10,
                    'name' => 'Haluaghat',
                    'bn_name' => 'হালুয়াঘাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            209 =>
                array(
                    'id' => 211,
                    'district_id' => 10,
                    'name' => 'Muktagachha',
                    'bn_name' => 'মুক্তাগাছা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            210 =>
                array(
                    'id' => 212,
                    'district_id' => 10,
                    'name' => 'Dhobaura',
                    'bn_name' => 'ধবারুয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            211 =>
                array(
                    'id' => 213,
                    'district_id' => 10,
                    'name' => 'Fulbaria',
                    'bn_name' => 'ফুলবাড়িয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            212 =>
                array(
                    'id' => 214,
                    'district_id' => 10,
                    'name' => 'Gaffargaon',
                    'bn_name' => 'গফরগাঁও',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            213 =>
                array(
                    'id' => 215,
                    'district_id' => 10,
                    'name' => 'Gauripur',
                    'bn_name' => 'গৌরিপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            214 =>
                array(
                    'id' => 216,
                    'district_id' => 10,
                    'name' => 'Ishwarganj',
                    'bn_name' => 'ঈশ্বরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            215 =>
                array(
                    'id' => 217,
                    'district_id' => 10,
                    'name' => 'Mymensingh Sadar',
                    'bn_name' => 'ময়মনসিং সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            216 =>
                array(
                    'id' => 218,
                    'district_id' => 10,
                    'name' => 'Nandail',
                    'bn_name' => 'নন্দাইল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            217 =>
                array(
                    'id' => 219,
                    'district_id' => 10,
                    'name' => 'Phulpur',
                    'bn_name' => 'ফুলপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            218 =>
                array(
                    'id' => 220,
                    'district_id' => 11,
                    'name' => 'Araihazar Upazila',
                    'bn_name' => 'আড়াইহাজার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            219 =>
                array(
                    'id' => 221,
                    'district_id' => 11,
                    'name' => 'Sonargaon Upazila',
                    'bn_name' => 'সোনারগাঁও',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            220 =>
                array(
                    'id' => 222,
                    'district_id' => 11,
                    'name' => 'Bandar',
                    'bn_name' => 'বান্দার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            221 =>
                array(
                    'id' => 223,
                    'district_id' => 11,
                    'name' => 'Naryanganj Sadar Upazila',
                    'bn_name' => 'নারায়ানগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            222 =>
                array(
                    'id' => 224,
                    'district_id' => 11,
                    'name' => 'Rupganj Upazila',
                    'bn_name' => 'রূপগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            223 =>
                array(
                    'id' => 225,
                    'district_id' => 11,
                    'name' => 'Siddirgonj Upazila',
                    'bn_name' => 'সিদ্ধিরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            224 =>
                array(
                    'id' => 226,
                    'district_id' => 12,
                    'name' => 'Belabo Upazila',
                    'bn_name' => 'বেলাবো',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            225 =>
                array(
                    'id' => 227,
                    'district_id' => 12,
                    'name' => 'Monohardi Upazila',
                    'bn_name' => 'মনোহরদি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            226 =>
                array(
                    'id' => 228,
                    'district_id' => 12,
                    'name' => 'Narsingdi Sadar Upazila',
                    'bn_name' => 'নরসিংদী সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            227 =>
                array(
                    'id' => 229,
                    'district_id' => 12,
                    'name' => 'Palash Upazila',
                    'bn_name' => 'পলাশ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            228 =>
                array(
                    'id' => 230,
                    'district_id' => 12,
                    'name' => 'Raipura Upazila, Narsingdi',
                    'bn_name' => 'রায়পুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            229 =>
                array(
                    'id' => 231,
                    'district_id' => 12,
                    'name' => 'Shibpur Upazila',
                    'bn_name' => 'শিবপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            230 =>
                array(
                    'id' => 232,
                    'district_id' => 13,
                    'name' => 'Kendua Upazilla',
                    'bn_name' => 'কেন্দুয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            231 =>
                array(
                    'id' => 233,
                    'district_id' => 13,
                    'name' => 'Atpara Upazilla',
                    'bn_name' => 'আটপাড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            232 =>
                array(
                    'id' => 234,
                    'district_id' => 13,
                    'name' => 'Barhatta Upazilla',
                    'bn_name' => 'বরহাট্টা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            233 =>
                array(
                    'id' => 235,
                    'district_id' => 13,
                    'name' => 'Durgapur Upazilla',
                    'bn_name' => 'দুর্গাপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            234 =>
                array(
                    'id' => 236,
                    'district_id' => 13,
                    'name' => 'Kalmakanda Upazilla',
                    'bn_name' => 'কলমাকান্দা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            235 =>
                array(
                    'id' => 237,
                    'district_id' => 13,
                    'name' => 'Madan Upazilla',
                    'bn_name' => 'মদন',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            236 =>
                array(
                    'id' => 238,
                    'district_id' => 13,
                    'name' => 'Mohanganj Upazilla',
                    'bn_name' => 'মোহনগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            237 =>
                array(
                    'id' => 239,
                    'district_id' => 13,
                    'name' => 'Netrakona-S Upazilla',
                    'bn_name' => 'নেত্রকোনা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            238 =>
                array(
                    'id' => 240,
                    'district_id' => 13,
                    'name' => 'Purbadhala Upazilla',
                    'bn_name' => 'পূর্বধলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            239 =>
                array(
                    'id' => 241,
                    'district_id' => 13,
                    'name' => 'Khaliajuri Upazilla',
                    'bn_name' => 'খালিয়াজুরি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            240 =>
                array(
                    'id' => 242,
                    'district_id' => 14,
                    'name' => 'Baliakandi Upazila',
                    'bn_name' => 'বালিয়াকান্দি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            241 =>
                array(
                    'id' => 243,
                    'district_id' => 14,
                    'name' => 'Goalandaghat Upazila',
                    'bn_name' => 'গোয়ালন্দ ঘাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            242 =>
                array(
                    'id' => 244,
                    'district_id' => 14,
                    'name' => 'Pangsha Upazila',
                    'bn_name' => 'পাংশা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            243 =>
                array(
                    'id' => 245,
                    'district_id' => 14,
                    'name' => 'Kalukhali Upazila',
                    'bn_name' => 'কালুখালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            244 =>
                array(
                    'id' => 246,
                    'district_id' => 14,
                    'name' => 'Rajbari Sadar Upazila',
                    'bn_name' => 'রাজবাড়ি সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            245 =>
                array(
                    'id' => 247,
                    'district_id' => 15,
                    'name' => 'Shariatpur Sadar -Palong',
                    'bn_name' => 'শরীয়তপুর সদর ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            246 =>
                array(
                    'id' => 248,
                    'district_id' => 15,
                    'name' => 'Damudya Upazila',
                    'bn_name' => 'দামুদিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            247 =>
                array(
                    'id' => 249,
                    'district_id' => 15,
                    'name' => 'Naria Upazila',
                    'bn_name' => 'নড়িয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            248 =>
                array(
                    'id' => 250,
                    'district_id' => 15,
                    'name' => 'Jajira Upazila',
                    'bn_name' => 'জাজিরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            249 =>
                array(
                    'id' => 251,
                    'district_id' => 15,
                    'name' => 'Bhedarganj Upazila',
                    'bn_name' => 'ভেদারগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            250 =>
                array(
                    'id' => 252,
                    'district_id' => 15,
                    'name' => 'Gosairhat Upazila',
                    'bn_name' => 'গোসাইর হাট ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            251 =>
                array(
                    'id' => 253,
                    'district_id' => 16,
                    'name' => 'Jhenaigati Upazila',
                    'bn_name' => 'ঝিনাইগাতি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            252 =>
                array(
                    'id' => 254,
                    'district_id' => 16,
                    'name' => 'Nakla Upazila',
                    'bn_name' => 'নাকলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            253 =>
                array(
                    'id' => 255,
                    'district_id' => 16,
                    'name' => 'Nalitabari Upazila',
                    'bn_name' => 'নালিতাবাড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            254 =>
                array(
                    'id' => 256,
                    'district_id' => 16,
                    'name' => 'Sherpur Sadar Upazila',
                    'bn_name' => 'শেরপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            255 =>
                array(
                    'id' => 257,
                    'district_id' => 16,
                    'name' => 'Sreebardi Upazila',
                    'bn_name' => 'শ্রীবরদি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            256 =>
                array(
                    'id' => 258,
                    'district_id' => 17,
                    'name' => 'Tangail Sadar Upazila',
                    'bn_name' => 'টাঙ্গাইল সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            257 =>
                array(
                    'id' => 259,
                    'district_id' => 17,
                    'name' => 'Sakhipur Upazila',
                    'bn_name' => 'সখিপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            258 =>
                array(
                    'id' => 260,
                    'district_id' => 17,
                    'name' => 'Basail Upazila',
                    'bn_name' => 'বসাইল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            259 =>
                array(
                    'id' => 261,
                    'district_id' => 17,
                    'name' => 'Madhupur Upazila',
                    'bn_name' => 'মধুপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            260 =>
                array(
                    'id' => 262,
                    'district_id' => 17,
                    'name' => 'Ghatail Upazila',
                    'bn_name' => 'ঘাটাইল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            261 =>
                array(
                    'id' => 263,
                    'district_id' => 17,
                    'name' => 'Kalihati Upazila',
                    'bn_name' => 'কালিহাতি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            262 =>
                array(
                    'id' => 264,
                    'district_id' => 17,
                    'name' => 'Nagarpur Upazila',
                    'bn_name' => 'নগরপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            263 =>
                array(
                    'id' => 265,
                    'district_id' => 17,
                    'name' => 'Mirzapur Upazila',
                    'bn_name' => 'মির্জাপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            264 =>
                array(
                    'id' => 266,
                    'district_id' => 17,
                    'name' => 'Gopalpur Upazila',
                    'bn_name' => 'গোপালপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            265 =>
                array(
                    'id' => 267,
                    'district_id' => 17,
                    'name' => 'Delduar Upazila',
                    'bn_name' => 'দেলদুয়ার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            266 =>
                array(
                    'id' => 268,
                    'district_id' => 17,
                    'name' => 'Bhuapur Upazila',
                    'bn_name' => 'ভুয়াপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            267 =>
                array(
                    'id' => 269,
                    'district_id' => 17,
                    'name' => 'Dhanbari Upazila',
                    'bn_name' => 'ধানবাড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            268 =>
                array(
                    'id' => 270,
                    'district_id' => 55,
                    'name' => 'Bagerhat Sadar Upazila',
                    'bn_name' => 'বাগেরহাট সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            269 =>
                array(
                    'id' => 271,
                    'district_id' => 55,
                    'name' => 'Chitalmari Upazila',
                    'bn_name' => 'চিতলমাড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            270 =>
                array(
                    'id' => 272,
                    'district_id' => 55,
                    'name' => 'Fakirhat Upazila',
                    'bn_name' => 'ফকিরহাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            271 =>
                array(
                    'id' => 273,
                    'district_id' => 55,
                    'name' => 'Kachua Upazila',
                    'bn_name' => 'কচুয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            272 =>
                array(
                    'id' => 274,
                    'district_id' => 55,
                    'name' => 'Mollahat Upazila',
                    'bn_name' => 'মোল্লাহাট ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            273 =>
                array(
                    'id' => 275,
                    'district_id' => 55,
                    'name' => 'Mongla Upazila',
                    'bn_name' => 'মংলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            274 =>
                array(
                    'id' => 276,
                    'district_id' => 55,
                    'name' => 'Morrelganj Upazila',
                    'bn_name' => 'মরেলগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            275 =>
                array(
                    'id' => 277,
                    'district_id' => 55,
                    'name' => 'Rampal Upazila',
                    'bn_name' => 'রামপাল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            276 =>
                array(
                    'id' => 278,
                    'district_id' => 55,
                    'name' => 'Sarankhola Upazila',
                    'bn_name' => 'স্মরণখোলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            277 =>
                array(
                    'id' => 279,
                    'district_id' => 56,
                    'name' => 'Damurhuda Upazila',
                    'bn_name' => 'দামুরহুদা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            278 =>
                array(
                    'id' => 280,
                    'district_id' => 56,
                    'name' => 'Chuadanga-S Upazila',
                    'bn_name' => 'চুয়াডাঙ্গা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            279 =>
                array(
                    'id' => 281,
                    'district_id' => 56,
                    'name' => 'Jibannagar Upazila',
                    'bn_name' => 'জীবন নগর ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            280 =>
                array(
                    'id' => 282,
                    'district_id' => 56,
                    'name' => 'Alamdanga Upazila',
                    'bn_name' => 'আলমডাঙ্গা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            281 =>
                array(
                    'id' => 283,
                    'district_id' => 57,
                    'name' => 'Abhaynagar Upazila',
                    'bn_name' => 'অভয়নগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            282 =>
                array(
                    'id' => 284,
                    'district_id' => 57,
                    'name' => 'Keshabpur Upazila',
                    'bn_name' => 'কেশবপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            283 =>
                array(
                    'id' => 285,
                    'district_id' => 57,
                    'name' => 'Bagherpara Upazila',
                    'bn_name' => 'বাঘের পাড়া ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            284 =>
                array(
                    'id' => 286,
                    'district_id' => 57,
                    'name' => 'Jessore Sadar Upazila',
                    'bn_name' => 'যশোর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            285 =>
                array(
                    'id' => 287,
                    'district_id' => 57,
                    'name' => 'Chaugachha Upazila',
                    'bn_name' => 'চৌগাছা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            286 =>
                array(
                    'id' => 288,
                    'district_id' => 57,
                    'name' => 'Manirampur Upazila',
                    'bn_name' => 'মনিরামপুর ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            287 =>
                array(
                    'id' => 289,
                    'district_id' => 57,
                    'name' => 'Jhikargachha Upazila',
                    'bn_name' => 'ঝিকরগাছা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            288 =>
                array(
                    'id' => 290,
                    'district_id' => 57,
                    'name' => 'Sharsha Upazila',
                    'bn_name' => 'সারশা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            289 =>
                array(
                    'id' => 291,
                    'district_id' => 58,
                    'name' => 'Jhenaidah Sadar Upazila',
                    'bn_name' => 'ঝিনাইদহ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            290 =>
                array(
                    'id' => 292,
                    'district_id' => 58,
                    'name' => 'Maheshpur Upazila',
                    'bn_name' => 'মহেশপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            291 =>
                array(
                    'id' => 293,
                    'district_id' => 58,
                    'name' => 'Kaliganj Upazila',
                    'bn_name' => 'কালীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            292 =>
                array(
                    'id' => 294,
                    'district_id' => 58,
                    'name' => 'Kotchandpur Upazila',
                    'bn_name' => 'কোট চাঁদপুর ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            293 =>
                array(
                    'id' => 295,
                    'district_id' => 58,
                    'name' => 'Shailkupa Upazila',
                    'bn_name' => 'শৈলকুপা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            294 =>
                array(
                    'id' => 296,
                    'district_id' => 58,
                    'name' => 'Harinakunda Upazila',
                    'bn_name' => 'হাড়িনাকুন্দা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            295 =>
                array(
                    'id' => 297,
                    'district_id' => 59,
                    'name' => 'Terokhada Upazila',
                    'bn_name' => 'তেরোখাদা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            296 =>
                array(
                    'id' => 298,
                    'district_id' => 59,
                    'name' => 'Batiaghata Upazila',
                    'bn_name' => 'বাটিয়াঘাটা ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            297 =>
                array(
                    'id' => 299,
                    'district_id' => 59,
                    'name' => 'Dacope Upazila',
                    'bn_name' => 'ডাকপে',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            298 =>
                array(
                    'id' => 300,
                    'district_id' => 59,
                    'name' => 'Dumuria Upazila',
                    'bn_name' => 'ডুমুরিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            299 =>
                array(
                    'id' => 301,
                    'district_id' => 59,
                    'name' => 'Dighalia Upazila',
                    'bn_name' => 'দিঘলিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            300 =>
                array(
                    'id' => 302,
                    'district_id' => 59,
                    'name' => 'Koyra Upazila',
                    'bn_name' => 'কয়ড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            301 =>
                array(
                    'id' => 303,
                    'district_id' => 59,
                    'name' => 'Paikgachha Upazila',
                    'bn_name' => 'পাইকগাছা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            302 =>
                array(
                    'id' => 304,
                    'district_id' => 59,
                    'name' => 'Phultala Upazila',
                    'bn_name' => 'ফুলতলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            303 =>
                array(
                    'id' => 305,
                    'district_id' => 59,
                    'name' => 'Rupsa Upazila',
                    'bn_name' => 'রূপসা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            304 =>
                array(
                    'id' => 306,
                    'district_id' => 60,
                    'name' => 'Kushtia Sadar',
                    'bn_name' => 'কুষ্টিয়া সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            305 =>
                array(
                    'id' => 307,
                    'district_id' => 60,
                    'name' => 'Kumarkhali',
                    'bn_name' => 'কুমারখালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            306 =>
                array(
                    'id' => 308,
                    'district_id' => 60,
                    'name' => 'Daulatpur',
                    'bn_name' => 'দৌলতপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            307 =>
                array(
                    'id' => 309,
                    'district_id' => 60,
                    'name' => 'Mirpur',
                    'bn_name' => 'মিরপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            308 =>
                array(
                    'id' => 310,
                    'district_id' => 60,
                    'name' => 'Bheramara',
                    'bn_name' => 'ভেরামারা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            309 =>
                array(
                    'id' => 311,
                    'district_id' => 60,
                    'name' => 'Khoksa',
                    'bn_name' => 'খোকসা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            310 =>
                array(
                    'id' => 312,
                    'district_id' => 61,
                    'name' => 'Magura Sadar Upazila',
                    'bn_name' => 'মাগুরা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            311 =>
                array(
                    'id' => 313,
                    'district_id' => 61,
                    'name' => 'Mohammadpur Upazila',
                    'bn_name' => 'মোহাম্মাদপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            312 =>
                array(
                    'id' => 314,
                    'district_id' => 61,
                    'name' => 'Shalikha Upazila',
                    'bn_name' => 'শালিখা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            313 =>
                array(
                    'id' => 315,
                    'district_id' => 61,
                    'name' => 'Sreepur Upazila',
                    'bn_name' => 'শ্রীপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            314 =>
                array(
                    'id' => 316,
                    'district_id' => 62,
                    'name' => 'angni Upazila',
                    'bn_name' => 'আংনি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            315 =>
                array(
                    'id' => 317,
                    'district_id' => 62,
                    'name' => 'Mujib Nagar Upazila',
                    'bn_name' => 'মুজিব নগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            316 =>
                array(
                    'id' => 318,
                    'district_id' => 62,
                    'name' => 'Meherpur-S Upazila',
                    'bn_name' => 'মেহেরপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            317 =>
                array(
                    'id' => 319,
                    'district_id' => 63,
                    'name' => 'Narail-S Upazilla',
                    'bn_name' => 'নড়াইল সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            318 =>
                array(
                    'id' => 320,
                    'district_id' => 63,
                    'name' => 'Lohagara Upazilla',
                    'bn_name' => 'লোহাগাড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            319 =>
                array(
                    'id' => 321,
                    'district_id' => 63,
                    'name' => 'Kalia Upazilla',
                    'bn_name' => 'কালিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            320 =>
                array(
                    'id' => 322,
                    'district_id' => 64,
                    'name' => 'Satkhira Sadar Upazila',
                    'bn_name' => 'সাতক্ষীরা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            321 =>
                array(
                    'id' => 323,
                    'district_id' => 64,
                    'name' => 'Assasuni Upazila',
                    'bn_name' => 'আসসাশুনি ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            322 =>
                array(
                    'id' => 324,
                    'district_id' => 64,
                    'name' => 'Debhata Upazila',
                    'bn_name' => 'দেভাটা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            323 =>
                array(
                    'id' => 325,
                    'district_id' => 64,
                    'name' => 'Tala Upazila',
                    'bn_name' => 'তালা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            324 =>
                array(
                    'id' => 326,
                    'district_id' => 64,
                    'name' => 'Kalaroa Upazila',
                    'bn_name' => 'কলরোয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            325 =>
                array(
                    'id' => 327,
                    'district_id' => 64,
                    'name' => 'Kaliganj Upazila',
                    'bn_name' => 'কালীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            326 =>
                array(
                    'id' => 328,
                    'district_id' => 64,
                    'name' => 'Shyamnagar Upazila',
                    'bn_name' => 'শ্যামনগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            327 =>
                array(
                    'id' => 329,
                    'district_id' => 18,
                    'name' => 'Adamdighi',
                    'bn_name' => 'আদমদিঘী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            328 =>
                array(
                    'id' => 330,
                    'district_id' => 18,
                    'name' => 'Bogra Sadar',
                    'bn_name' => 'বগুড়া সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            329 =>
                array(
                    'id' => 331,
                    'district_id' => 18,
                    'name' => 'Sherpur',
                    'bn_name' => 'শেরপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            330 =>
                array(
                    'id' => 332,
                    'district_id' => 18,
                    'name' => 'Dhunat',
                    'bn_name' => 'ধুনট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            331 =>
                array(
                    'id' => 333,
                    'district_id' => 18,
                    'name' => 'Dhupchanchia',
                    'bn_name' => 'দুপচাচিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            332 =>
                array(
                    'id' => 334,
                    'district_id' => 18,
                    'name' => 'Gabtali',
                    'bn_name' => 'গাবতলি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            333 =>
                array(
                    'id' => 335,
                    'district_id' => 18,
                    'name' => 'Kahaloo',
                    'bn_name' => 'কাহালু',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            334 =>
                array(
                    'id' => 336,
                    'district_id' => 18,
                    'name' => 'Nandigram',
                    'bn_name' => 'নন্দিগ্রাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            335 =>
                array(
                    'id' => 337,
                    'district_id' => 18,
                    'name' => 'Sahajanpur',
                    'bn_name' => 'শাহজাহানপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            336 =>
                array(
                    'id' => 338,
                    'district_id' => 18,
                    'name' => 'Sariakandi',
                    'bn_name' => 'সারিয়াকান্দি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            337 =>
                array(
                    'id' => 339,
                    'district_id' => 18,
                    'name' => 'Shibganj',
                    'bn_name' => 'শিবগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            338 =>
                array(
                    'id' => 340,
                    'district_id' => 18,
                    'name' => 'Sonatala',
                    'bn_name' => 'সোনাতলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            339 =>
                array(
                    'id' => 341,
                    'district_id' => 19,
                    'name' => 'Joypurhat S',
                    'bn_name' => 'জয়পুরহাট সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            340 =>
                array(
                    'id' => 342,
                    'district_id' => 19,
                    'name' => 'Akkelpur',
                    'bn_name' => 'আক্কেলপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            341 =>
                array(
                    'id' => 343,
                    'district_id' => 19,
                    'name' => 'Kalai',
                    'bn_name' => 'কালাই',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            342 =>
                array(
                    'id' => 344,
                    'district_id' => 19,
                    'name' => 'Khetlal',
                    'bn_name' => 'খেতলাল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            343 =>
                array(
                    'id' => 345,
                    'district_id' => 19,
                    'name' => 'Panchbibi',
                    'bn_name' => 'পাঁচবিবি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            344 =>
                array(
                    'id' => 346,
                    'district_id' => 20,
                    'name' => 'Naogaon Sadar Upazila',
                    'bn_name' => 'নওগাঁ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            345 =>
                array(
                    'id' => 347,
                    'district_id' => 20,
                    'name' => 'Mohadevpur Upazila',
                    'bn_name' => 'মহাদেবপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            346 =>
                array(
                    'id' => 348,
                    'district_id' => 20,
                    'name' => 'Manda Upazila',
                    'bn_name' => 'মান্দা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            347 =>
                array(
                    'id' => 349,
                    'district_id' => 20,
                    'name' => 'Niamatpur Upazila',
                    'bn_name' => 'নিয়ামতপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            348 =>
                array(
                    'id' => 350,
                    'district_id' => 20,
                    'name' => 'Atrai Upazila',
                    'bn_name' => 'আত্রাই',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            349 =>
                array(
                    'id' => 351,
                    'district_id' => 20,
                    'name' => 'Raninagar Upazila',
                    'bn_name' => 'রাণীনগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            350 =>
                array(
                    'id' => 352,
                    'district_id' => 20,
                    'name' => 'Patnitala Upazila',
                    'bn_name' => 'পত্নীতলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            351 =>
                array(
                    'id' => 353,
                    'district_id' => 20,
                    'name' => 'Dhamoirhat Upazila',
                    'bn_name' => 'ধামইরহাট ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            352 =>
                array(
                    'id' => 354,
                    'district_id' => 20,
                    'name' => 'Sapahar Upazila',
                    'bn_name' => 'সাপাহার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            353 =>
                array(
                    'id' => 355,
                    'district_id' => 20,
                    'name' => 'Porsha Upazila',
                    'bn_name' => 'পোরশা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            354 =>
                array(
                    'id' => 356,
                    'district_id' => 20,
                    'name' => 'Badalgachhi Upazila',
                    'bn_name' => 'বদলগাছি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            355 =>
                array(
                    'id' => 357,
                    'district_id' => 21,
                    'name' => 'Natore Sadar Upazila',
                    'bn_name' => 'নাটোর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            356 =>
                array(
                    'id' => 358,
                    'district_id' => 21,
                    'name' => 'Baraigram Upazila',
                    'bn_name' => 'বড়াইগ্রাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            357 =>
                array(
                    'id' => 359,
                    'district_id' => 21,
                    'name' => 'Bagatipara Upazila',
                    'bn_name' => 'বাগাতিপাড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            358 =>
                array(
                    'id' => 360,
                    'district_id' => 21,
                    'name' => 'Lalpur Upazila',
                    'bn_name' => 'লালপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            359 =>
                array(
                    'id' => 361,
                    'district_id' => 21,
                    'name' => 'Natore Sadar Upazila',
                    'bn_name' => 'নাটোর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            360 =>
                array(
                    'id' => 362,
                    'district_id' => 21,
                    'name' => 'Baraigram Upazila',
                    'bn_name' => 'বড়াই গ্রাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            361 =>
                array(
                    'id' => 363,
                    'district_id' => 22,
                    'name' => 'Bholahat Upazila',
                    'bn_name' => 'ভোলাহাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            362 =>
                array(
                    'id' => 364,
                    'district_id' => 22,
                    'name' => 'Gomastapur Upazila',
                    'bn_name' => 'গোমস্তাপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            363 =>
                array(
                    'id' => 365,
                    'district_id' => 22,
                    'name' => 'Nachole Upazila',
                    'bn_name' => 'নাচোল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            364 =>
                array(
                    'id' => 366,
                    'district_id' => 22,
                    'name' => 'Nawabganj Sadar Upazila',
                    'bn_name' => 'নবাবগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            365 =>
                array(
                    'id' => 367,
                    'district_id' => 22,
                    'name' => 'Shibganj Upazila',
                    'bn_name' => 'শিবগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            366 =>
                array(
                    'id' => 368,
                    'district_id' => 23,
                    'name' => 'Atgharia Upazila',
                    'bn_name' => 'আটঘরিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            367 =>
                array(
                    'id' => 369,
                    'district_id' => 23,
                    'name' => 'Bera Upazila',
                    'bn_name' => 'বেড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            368 =>
                array(
                    'id' => 370,
                    'district_id' => 23,
                    'name' => 'Bhangura Upazila',
                    'bn_name' => 'ভাঙ্গুরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            369 =>
                array(
                    'id' => 371,
                    'district_id' => 23,
                    'name' => 'Chatmohar Upazila',
                    'bn_name' => 'চাটমোহর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            370 =>
                array(
                    'id' => 372,
                    'district_id' => 23,
                    'name' => 'Faridpur Upazila',
                    'bn_name' => 'ফরিদপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            371 =>
                array(
                    'id' => 373,
                    'district_id' => 23,
                    'name' => 'Ishwardi Upazila',
                    'bn_name' => 'ঈশ্বরদী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            372 =>
                array(
                    'id' => 374,
                    'district_id' => 23,
                    'name' => 'Pabna Sadar Upazila',
                    'bn_name' => 'পাবনা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            373 =>
                array(
                    'id' => 375,
                    'district_id' => 23,
                    'name' => 'Santhia Upazila',
                    'bn_name' => 'সাথিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            374 =>
                array(
                    'id' => 376,
                    'district_id' => 23,
                    'name' => 'Sujanagar Upazila',
                    'bn_name' => 'সুজানগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            375 =>
                array(
                    'id' => 377,
                    'district_id' => 24,
                    'name' => 'Bagha',
                    'bn_name' => 'বাঘা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            376 =>
                array(
                    'id' => 378,
                    'district_id' => 24,
                    'name' => 'Bagmara',
                    'bn_name' => 'বাগমারা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            377 =>
                array(
                    'id' => 379,
                    'district_id' => 24,
                    'name' => 'Charghat',
                    'bn_name' => 'চারঘাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            378 =>
                array(
                    'id' => 380,
                    'district_id' => 24,
                    'name' => 'Durgapur',
                    'bn_name' => 'দুর্গাপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            379 =>
                array(
                    'id' => 381,
                    'district_id' => 24,
                    'name' => 'Godagari',
                    'bn_name' => 'গোদাগারি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            380 =>
                array(
                    'id' => 382,
                    'district_id' => 24,
                    'name' => 'Mohanpur',
                    'bn_name' => 'মোহনপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            381 =>
                array(
                    'id' => 383,
                    'district_id' => 24,
                    'name' => 'Paba',
                    'bn_name' => 'পবা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            382 =>
                array(
                    'id' => 384,
                    'district_id' => 24,
                    'name' => 'Puthia',
                    'bn_name' => 'পুঠিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            383 =>
                array(
                    'id' => 385,
                    'district_id' => 24,
                    'name' => 'Tanore',
                    'bn_name' => 'তানোর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            384 =>
                array(
                    'id' => 386,
                    'district_id' => 25,
                    'name' => 'Sirajganj Sadar Upazila',
                    'bn_name' => 'সিরাজগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            385 =>
                array(
                    'id' => 387,
                    'district_id' => 25,
                    'name' => 'Belkuchi Upazila',
                    'bn_name' => 'বেলকুচি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            386 =>
                array(
                    'id' => 388,
                    'district_id' => 25,
                    'name' => 'Chauhali Upazila',
                    'bn_name' => 'চৌহালি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            387 =>
                array(
                    'id' => 389,
                    'district_id' => 25,
                    'name' => 'Kamarkhanda Upazila',
                    'bn_name' => 'কামারখান্দা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            388 =>
                array(
                    'id' => 390,
                    'district_id' => 25,
                    'name' => 'Kazipur Upazila',
                    'bn_name' => 'কাজীপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            389 =>
                array(
                    'id' => 391,
                    'district_id' => 25,
                    'name' => 'Raiganj Upazila',
                    'bn_name' => 'রায়গঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            390 =>
                array(
                    'id' => 392,
                    'district_id' => 25,
                    'name' => 'Shahjadpur Upazila',
                    'bn_name' => 'শাহজাদপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            391 =>
                array(
                    'id' => 393,
                    'district_id' => 25,
                    'name' => 'Tarash Upazila',
                    'bn_name' => 'তারাশ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            392 =>
                array(
                    'id' => 394,
                    'district_id' => 25,
                    'name' => 'Ullahpara Upazila',
                    'bn_name' => 'উল্লাপাড়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            393 =>
                array(
                    'id' => 395,
                    'district_id' => 26,
                    'name' => 'Birampur Upazila',
                    'bn_name' => 'বিরামপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            394 =>
                array(
                    'id' => 396,
                    'district_id' => 26,
                    'name' => 'Birganj',
                    'bn_name' => 'বীরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            395 =>
                array(
                    'id' => 397,
                    'district_id' => 26,
                    'name' => 'Biral Upazila',
                    'bn_name' => 'বিড়াল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            396 =>
                array(
                    'id' => 398,
                    'district_id' => 26,
                    'name' => 'Bochaganj Upazila',
                    'bn_name' => 'বোচাগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            397 =>
                array(
                    'id' => 399,
                    'district_id' => 26,
                    'name' => 'Chirirbandar Upazila',
                    'bn_name' => 'চিরিরবন্দর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            398 =>
                array(
                    'id' => 400,
                    'district_id' => 26,
                    'name' => 'Phulbari Upazila',
                    'bn_name' => 'ফুলবাড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            399 =>
                array(
                    'id' => 401,
                    'district_id' => 26,
                    'name' => 'Ghoraghat Upazila',
                    'bn_name' => 'ঘোড়াঘাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            400 =>
                array(
                    'id' => 402,
                    'district_id' => 26,
                    'name' => 'Hakimpur Upazila',
                    'bn_name' => 'হাকিমপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            401 =>
                array(
                    'id' => 403,
                    'district_id' => 26,
                    'name' => 'Kaharole Upazila',
                    'bn_name' => 'কাহারোল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            402 =>
                array(
                    'id' => 404,
                    'district_id' => 26,
                    'name' => 'Khansama Upazila',
                    'bn_name' => 'খানসামা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            403 =>
                array(
                    'id' => 405,
                    'district_id' => 26,
                    'name' => 'Dinajpur Sadar Upazila',
                    'bn_name' => 'দিনাজপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            404 =>
                array(
                    'id' => 406,
                    'district_id' => 26,
                    'name' => 'Nawabganj',
                    'bn_name' => 'নবাবগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            405 =>
                array(
                    'id' => 407,
                    'district_id' => 26,
                    'name' => 'Parbatipur Upazila',
                    'bn_name' => 'পার্বতীপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            406 =>
                array(
                    'id' => 408,
                    'district_id' => 27,
                    'name' => 'Fulchhari',
                    'bn_name' => 'ফুলছড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            407 =>
                array(
                    'id' => 409,
                    'district_id' => 27,
                    'name' => 'Gaibandha sadar',
                    'bn_name' => 'গাইবান্ধা সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            408 =>
                array(
                    'id' => 410,
                    'district_id' => 27,
                    'name' => 'Gobindaganj',
                    'bn_name' => 'গোবিন্দগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            409 =>
                array(
                    'id' => 411,
                    'district_id' => 27,
                    'name' => 'Palashbari',
                    'bn_name' => 'পলাশবাড়ী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            410 =>
                array(
                    'id' => 412,
                    'district_id' => 27,
                    'name' => 'Sadullapur',
                    'bn_name' => 'সাদুল্যাপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            411 =>
                array(
                    'id' => 413,
                    'district_id' => 27,
                    'name' => 'Saghata',
                    'bn_name' => 'সাঘাটা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            412 =>
                array(
                    'id' => 414,
                    'district_id' => 27,
                    'name' => 'Sundarganj',
                    'bn_name' => 'সুন্দরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            413 =>
                array(
                    'id' => 415,
                    'district_id' => 28,
                    'name' => 'Kurigram Sadar',
                    'bn_name' => 'কুড়িগ্রাম সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            414 =>
                array(
                    'id' => 416,
                    'district_id' => 28,
                    'name' => 'Nageshwari',
                    'bn_name' => 'নাগেশ্বরী',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            415 =>
                array(
                    'id' => 417,
                    'district_id' => 28,
                    'name' => 'Bhurungamari',
                    'bn_name' => 'ভুরুঙ্গামারি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            416 =>
                array(
                    'id' => 418,
                    'district_id' => 28,
                    'name' => 'Phulbari',
                    'bn_name' => 'ফুলবাড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            417 =>
                array(
                    'id' => 419,
                    'district_id' => 28,
                    'name' => 'Rajarhat',
                    'bn_name' => 'রাজারহাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            418 =>
                array(
                    'id' => 420,
                    'district_id' => 28,
                    'name' => 'Ulipur',
                    'bn_name' => 'উলিপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            419 =>
                array(
                    'id' => 421,
                    'district_id' => 28,
                    'name' => 'Chilmari',
                    'bn_name' => 'চিলমারি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            420 =>
                array(
                    'id' => 422,
                    'district_id' => 28,
                    'name' => 'Rowmari',
                    'bn_name' => 'রউমারি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            421 =>
                array(
                    'id' => 423,
                    'district_id' => 28,
                    'name' => 'Char Rajibpur',
                    'bn_name' => 'চর রাজিবপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            422 =>
                array(
                    'id' => 424,
                    'district_id' => 29,
                    'name' => 'Lalmanirhat Sadar',
                    'bn_name' => 'লালমনিরহাট সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            423 =>
                array(
                    'id' => 425,
                    'district_id' => 29,
                    'name' => 'Aditmari',
                    'bn_name' => 'আদিতমারি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            424 =>
                array(
                    'id' => 426,
                    'district_id' => 29,
                    'name' => 'Kaliganj',
                    'bn_name' => 'কালীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            425 =>
                array(
                    'id' => 427,
                    'district_id' => 29,
                    'name' => 'Hatibandha',
                    'bn_name' => 'হাতিবান্ধা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            426 =>
                array(
                    'id' => 428,
                    'district_id' => 29,
                    'name' => 'Patgram',
                    'bn_name' => 'পাটগ্রাম',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            427 =>
                array(
                    'id' => 429,
                    'district_id' => 30,
                    'name' => 'Nilphamari Sadar',
                    'bn_name' => 'নীলফামারী সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            428 =>
                array(
                    'id' => 430,
                    'district_id' => 30,
                    'name' => 'Saidpur',
                    'bn_name' => 'সৈয়দপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            429 =>
                array(
                    'id' => 431,
                    'district_id' => 30,
                    'name' => 'Jaldhaka',
                    'bn_name' => 'জলঢাকা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            430 =>
                array(
                    'id' => 432,
                    'district_id' => 30,
                    'name' => 'Kishoreganj',
                    'bn_name' => 'কিশোরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            431 =>
                array(
                    'id' => 433,
                    'district_id' => 30,
                    'name' => 'Domar',
                    'bn_name' => 'ডোমার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            432 =>
                array(
                    'id' => 434,
                    'district_id' => 30,
                    'name' => 'Dimla',
                    'bn_name' => 'ডিমলা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            433 =>
                array(
                    'id' => 435,
                    'district_id' => 31,
                    'name' => 'Panchagarh Sadar',
                    'bn_name' => 'পঞ্চগড় সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            434 =>
                array(
                    'id' => 436,
                    'district_id' => 31,
                    'name' => 'Debiganj',
                    'bn_name' => 'দেবীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            435 =>
                array(
                    'id' => 437,
                    'district_id' => 31,
                    'name' => 'Boda',
                    'bn_name' => 'বোদা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            436 =>
                array(
                    'id' => 438,
                    'district_id' => 31,
                    'name' => 'Atwari',
                    'bn_name' => 'আটোয়ারি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            437 =>
                array(
                    'id' => 439,
                    'district_id' => 31,
                    'name' => 'Tetulia',
                    'bn_name' => 'তেতুলিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            438 =>
                array(
                    'id' => 440,
                    'district_id' => 32,
                    'name' => 'Badarganj',
                    'bn_name' => 'বদরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            439 =>
                array(
                    'id' => 441,
                    'district_id' => 32,
                    'name' => 'Mithapukur',
                    'bn_name' => 'মিঠাপুকুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            440 =>
                array(
                    'id' => 442,
                    'district_id' => 32,
                    'name' => 'Gangachara',
                    'bn_name' => 'গঙ্গাচরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            441 =>
                array(
                    'id' => 443,
                    'district_id' => 32,
                    'name' => 'Kaunia',
                    'bn_name' => 'কাউনিয়া',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            442 =>
                array(
                    'id' => 444,
                    'district_id' => 32,
                    'name' => 'Rangpur Sadar',
                    'bn_name' => 'রংপুর সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            443 =>
                array(
                    'id' => 445,
                    'district_id' => 32,
                    'name' => 'Pirgachha',
                    'bn_name' => 'পীরগাছা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            444 =>
                array(
                    'id' => 446,
                    'district_id' => 32,
                    'name' => 'Pirganj',
                    'bn_name' => 'পীরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            445 =>
                array(
                    'id' => 447,
                    'district_id' => 32,
                    'name' => 'Taraganj',
                    'bn_name' => 'তারাগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            446 =>
                array(
                    'id' => 448,
                    'district_id' => 33,
                    'name' => 'Thakurgaon Sadar Upazila',
                    'bn_name' => 'ঠাকুরগাঁও সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            447 =>
                array(
                    'id' => 449,
                    'district_id' => 33,
                    'name' => 'Pirganj Upazila',
                    'bn_name' => 'পীরগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            448 =>
                array(
                    'id' => 450,
                    'district_id' => 33,
                    'name' => 'Baliadangi Upazila',
                    'bn_name' => 'বালিয়াডাঙ্গি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            449 =>
                array(
                    'id' => 451,
                    'district_id' => 33,
                    'name' => 'Haripur Upazila',
                    'bn_name' => 'হরিপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            450 =>
                array(
                    'id' => 452,
                    'district_id' => 33,
                    'name' => 'Ranisankail Upazila',
                    'bn_name' => 'রাণীসংকইল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            451 =>
                array(
                    'id' => 453,
                    'district_id' => 51,
                    'name' => 'Ajmiriganj',
                    'bn_name' => 'আজমিরিগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            452 =>
                array(
                    'id' => 454,
                    'district_id' => 51,
                    'name' => 'Baniachang',
                    'bn_name' => 'বানিয়াচং',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            453 =>
                array(
                    'id' => 455,
                    'district_id' => 51,
                    'name' => 'Bahubal',
                    'bn_name' => 'বাহুবল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            454 =>
                array(
                    'id' => 456,
                    'district_id' => 51,
                    'name' => 'Chunarughat',
                    'bn_name' => 'চুনারুঘাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            455 =>
                array(
                    'id' => 457,
                    'district_id' => 51,
                    'name' => 'Habiganj Sadar',
                    'bn_name' => 'হবিগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            456 =>
                array(
                    'id' => 458,
                    'district_id' => 51,
                    'name' => 'Lakhai',
                    'bn_name' => 'লাক্ষাই',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            457 =>
                array(
                    'id' => 459,
                    'district_id' => 51,
                    'name' => 'Madhabpur',
                    'bn_name' => 'মাধবপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            458 =>
                array(
                    'id' => 460,
                    'district_id' => 51,
                    'name' => 'Nabiganj',
                    'bn_name' => 'নবীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            459 =>
                array(
                    'id' => 461,
                    'district_id' => 51,
                    'name' => 'Shaistagonj Upazila',
                    'bn_name' => 'শায়েস্তাগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            460 =>
                array(
                    'id' => 462,
                    'district_id' => 52,
                    'name' => 'Moulvibazar Sadar',
                    'bn_name' => 'মৌলভীবাজার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            461 =>
                array(
                    'id' => 463,
                    'district_id' => 52,
                    'name' => 'Barlekha',
                    'bn_name' => 'বড়লেখা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            462 =>
                array(
                    'id' => 464,
                    'district_id' => 52,
                    'name' => 'Juri',
                    'bn_name' => 'জুড়ি',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            463 =>
                array(
                    'id' => 465,
                    'district_id' => 52,
                    'name' => 'Kamalganj',
                    'bn_name' => 'কামালগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            464 =>
                array(
                    'id' => 466,
                    'district_id' => 52,
                    'name' => 'Kulaura',
                    'bn_name' => 'কুলাউরা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            465 =>
                array(
                    'id' => 467,
                    'district_id' => 52,
                    'name' => 'Rajnagar',
                    'bn_name' => 'রাজনগর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            466 =>
                array(
                    'id' => 468,
                    'district_id' => 52,
                    'name' => 'Sreemangal',
                    'bn_name' => 'শ্রীমঙ্গল',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            467 =>
                array(
                    'id' => 469,
                    'district_id' => 53,
                    'name' => 'Bishwamvarpur',
                    'bn_name' => 'বিসশম্ভারপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            468 =>
                array(
                    'id' => 470,
                    'district_id' => 53,
                    'name' => 'Chhatak',
                    'bn_name' => 'ছাতক',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            469 =>
                array(
                    'id' => 471,
                    'district_id' => 53,
                    'name' => 'Derai',
                    'bn_name' => 'দেড়াই',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            470 =>
                array(
                    'id' => 472,
                    'district_id' => 53,
                    'name' => 'Dharampasha',
                    'bn_name' => 'ধরমপাশা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            471 =>
                array(
                    'id' => 473,
                    'district_id' => 53,
                    'name' => 'Dowarabazar',
                    'bn_name' => 'দোয়ারাবাজার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            472 =>
                array(
                    'id' => 474,
                    'district_id' => 53,
                    'name' => 'Jagannathpur',
                    'bn_name' => 'জগন্নাথপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            473 =>
                array(
                    'id' => 475,
                    'district_id' => 53,
                    'name' => 'Jamalganj',
                    'bn_name' => 'জামালগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            474 =>
                array(
                    'id' => 476,
                    'district_id' => 53,
                    'name' => 'Sulla',
                    'bn_name' => 'সুল্লা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            475 =>
                array(
                    'id' => 477,
                    'district_id' => 53,
                    'name' => 'Sunamganj Sadar',
                    'bn_name' => 'সুনামগঞ্জ সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            476 =>
                array(
                    'id' => 478,
                    'district_id' => 53,
                    'name' => 'Shanthiganj',
                    'bn_name' => 'শান্তিগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            477 =>
                array(
                    'id' => 479,
                    'district_id' => 53,
                    'name' => 'Tahirpur',
                    'bn_name' => 'তাহিরপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            478 =>
                array(
                    'id' => 480,
                    'district_id' => 54,
                    'name' => 'Sylhet Sadar',
                    'bn_name' => 'সিলেট সদর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            479 =>
                array(
                    'id' => 481,
                    'district_id' => 54,
                    'name' => 'Beanibazar',
                    'bn_name' => 'বেয়ানিবাজার',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            480 =>
                array(
                    'id' => 482,
                    'district_id' => 54,
                    'name' => 'Bishwanath',
                    'bn_name' => 'বিশ্বনাথ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            481 =>
                array(
                    'id' => 483,
                    'district_id' => 54,
                    'name' => 'Dakshin Surma Upazila',
                    'bn_name' => 'দক্ষিণ সুরমা',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            482 =>
                array(
                    'id' => 484,
                    'district_id' => 54,
                    'name' => 'Balaganj',
                    'bn_name' => 'বালাগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            483 =>
                array(
                    'id' => 485,
                    'district_id' => 54,
                    'name' => 'Companiganj',
                    'bn_name' => 'কোম্পানিগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            484 =>
                array(
                    'id' => 486,
                    'district_id' => 54,
                    'name' => 'Fenchuganj',
                    'bn_name' => 'ফেঞ্চুগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            485 =>
                array(
                    'id' => 487,
                    'district_id' => 54,
                    'name' => 'Golapganj',
                    'bn_name' => 'গোলাপগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            486 =>
                array(
                    'id' => 488,
                    'district_id' => 54,
                    'name' => 'Gowainghat',
                    'bn_name' => 'গোয়াইনঘাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            487 =>
                array(
                    'id' => 489,
                    'district_id' => 54,
                    'name' => 'Jaintiapur',
                    'bn_name' => 'জয়ন্তপুর',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            488 =>
                array(
                    'id' => 490,
                    'district_id' => 54,
                    'name' => 'Kanaighat',
                    'bn_name' => 'কানাইঘাট',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            489 =>
                array(
                    'id' => 491,
                    'district_id' => 54,
                    'name' => 'Zakiganj',
                    'bn_name' => 'জাকিগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            490 =>
                array(
                    'id' => 492,
                    'district_id' => 54,
                    'name' => 'Nobigonj',
                    'bn_name' => 'নবীগঞ্জ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}
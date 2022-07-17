<?php

use Illuminate\Database\Seeder;

class TmsSubSectorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tms_sub_sectors')->delete();
        
        \DB::table('tms_sub_sectors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tms_sector_id' => 2,
                'code' => '2004290507263010',
                'title_english' => 'Training allowance for trainees',
                'title_bangla' => 'প্রশিক্ষণার্থীদের প্রশিক্ষণ ভাতা',
                'sequence' => 1,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            1 => 
            array (
                'id' => 2,
                'tms_sector_id' => 2,
                'code' => '2004290507265611',
                'title_english' => 'Hostel charge for trainees',
                'title_bangla' => 'প্রশিক্ষণার্থীদের হোস্টেল চার্জ',
                'sequence' => 2,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            2 => 
            array (
                'id' => 3,
                'tms_sector_id' => 2,
                'code' => '2004290507266691',
                'title_english' => 'Hostel charge for resource persons',
                'title_bangla' => 'রিসোর্স পার্সনদের হোস্টেল চার্জ',
                'sequence' => 3,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            3 => 
            array (
                'id' => 4,
                'tms_sector_id' => 2,
                'code' => '2004290507263974',
                'title_english' => 'Insect Allowance',
                'title_bangla' => 'কীট এলাউন্স',
                'sequence' => 4,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            4 => 
            array (
                'id' => 5,
                'tms_sector_id' => 2,
                'code' => '2004290507266289',
                'title_english' => 'Karmapaddik tea',
                'title_bangla' => 'কর্মোপদ্দীক চা',
                'sequence' => 5,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            5 => 
            array (
                'id' => 6,
                'tms_sector_id' => 2,
                'code' => '2004290507262650',
                'title_english' => 'Certificates and folder expenses',
                'title_bangla' => 'সনদপত্র ও ফোল্ডার ব্যয়',
                'sequence' => 6,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            6 => 
            array (
                'id' => 7,
                'tms_sector_id' => 2,
                'code' => '2004290507269930',
                'title_english' => 'Book allowance for trainees',
                'title_bangla' => 'প্রশিক্ষণার্থীদের পুস্তক ভাতা',
                'sequence' => 7,
                'details' => NULL,
                'created_at' => '2020-04-29 17:07:26',
                'updated_at' => '2020-04-29 17:07:26',
            ),
            7 => 
            array (
                'id' => 8,
                'tms_sector_id' => 3,
                'code' => '2004290522112565',
                'title_english' => 'Conference rooms, classrooms rent',
                'title_bangla' => 'সম্মেলন কক্ষ, শ্রেণী কক্ষ ভাড়া',
                'sequence' => 1,
                'details' => NULL,
                'created_at' => '2020-04-29 17:22:11',
                'updated_at' => '2020-04-29 17:22:11',
            ),
            8 => 
            array (
                'id' => 9,
                'tms_sector_id' => 3,
                'code' => '2004290522113939',
                'title_english' => 'Rent of auditorium and sound system for organizing midterm get-togethers, cultural events and other events',
                'title_bangla' => 'মিডটার্ম গেট-টুগেদার, সাংস্কৃতিক অনুষ্ঠান আয়োজনসহ অন্যান্য অনুষ্ঠান আয়োজনের জন্য অডিটরিয়াম ও সাউন্ড সিস্টেম ভাড়া',
                'sequence' => 2,
                'details' => NULL,
                'created_at' => '2020-04-29 17:22:11',
                'updated_at' => '2020-04-29 17:22:11',
            ),
            9 => 
            array (
                'id' => 10,
                'tms_sector_id' => 3,
                'code' => '2004290545223846',
                'title_english' => 'Charge of audio visual, multimedia, gas, electricity, water, cleaning etc.',
                'title_bangla' => 'অডিও ভিজুয়েল, মাল্টিমিডিয়া, গ্যাস, বিদ্যুৎ, পানি, পরিষ্কার পরিচ্ছন্নতা ইত্যাদি  চার্জ',
                'sequence' => 3,
                'details' => NULL,
                'created_at' => '2020-04-29 17:45:22',
                'updated_at' => '2020-04-29 17:45:22',
            ),
            10 => 
            array (
                'id' => 11,
                'tms_sector_id' => 3,
                'code' => '2004290545227027',
                'title_english' => 'Generator fuel charge',
                'title_bangla' => 'জেনারেটর ফুয়েল চার্জ',
                'sequence' => 4,
                'details' => NULL,
                'created_at' => '2020-04-29 17:45:22',
                'updated_at' => '2020-04-29 17:45:22',
            ),
            11 => 
            array (
                'id' => 12,
                'tms_sector_id' => 3,
                'code' => '2004290545229328',
            'title_english' => 'Postal, wire and telephony, Internet (with re-enabled)',
            'title_bangla' => 'ডাক, তার ও দূরালাপনী, ইন্টারনেট (রি-ভর সুযোগসহ)',
                'sequence' => 5,
                'details' => NULL,
                'created_at' => '2020-04-29 17:45:22',
                'updated_at' => '2020-04-29 17:45:22',
            ),
            12 => 
            array (
                'id' => 13,
                'tms_sector_id' => 3,
                'code' => '2004290545221932',
                'title_english' => 'Medical facilities',
                'title_bangla' => 'চিকিৎসা সুবিধা',
                'sequence' => 6,
                'details' => NULL,
                'created_at' => '2020-04-29 17:45:22',
                'updated_at' => '2020-04-29 17:45:22',
            ),
            13 => 
            array (
                'id' => 14,
                'tms_sector_id' => 4,
                'code' => '2004290549496825',
                'title_english' => 'Honorable speaker Charge',
                'title_bangla' => 'বক্তার সম্মানী',
                'sequence' => 1,
                'details' => NULL,
                'created_at' => '2020-04-29 17:49:49',
                'updated_at' => '2020-04-29 17:49:49',
            ),
            14 => 
            array (
                'id' => 15,
                'tms_sector_id' => 4,
                'code' => '2004290549495404',
                'title_english' => 'Honorable Guest Speaker Charge',
                'title_bangla' => 'অতিথি বক্তার সম্মানী',
                'sequence' => 2,
                'details' => NULL,
                'created_at' => '2020-04-29 17:49:49',
                'updated_at' => '2020-04-29 17:49:49',
            ),
            15 => 
            array (
                'id' => 16,
                'tms_sector_id' => 4,
                'code' => '2004290549492985',
                'title_english' => 'Remuneration of book review guides',
                'title_bangla' => 'পুস্তক পর্যালোচনা গাইডদের পারিশ্রমিক',
                'sequence' => 3,
                'details' => NULL,
                'created_at' => '2020-04-29 17:49:49',
                'updated_at' => '2020-04-29 17:49:49',
            ),
            16 => 
            array (
                'id' => 17,
                'tms_sector_id' => 4,
                'code' => '2004290549498528',
                'title_english' => 'Remuneration of Guides for field surveys',
                'title_bangla' => 'মাঠ সমীক্ষা’র জন্য গাইডদের পারিশ্রমিক',
                'sequence' => 4,
                'details' => NULL,
                'created_at' => '2020-04-29 17:49:49',
                'updated_at' => '2020-04-29 17:49:49',
            ),
            17 => 
            array (
                'id' => 18,
                'tms_sector_id' => 4,
                'code' => '2004290549495865',
                'title_english' => 'Expenditure on religious, cultural and social events',
                'title_bangla' => 'ধর্মীয়, সাংস্কৃতিক ও সামাজিক অনুষ্ঠান ব্যয়',
                'sequence' => 5,
                'details' => NULL,
                'created_at' => '2020-04-29 17:49:49',
                'updated_at' => '2020-04-29 17:49:49',
            ),
            18 => 
            array (
                'id' => 19,
                'tms_sector_id' => 3,
                'code' => '2005180754255952',
                'title_english' => 'Bags for trainees and those involved in course management',
                'title_bangla' => 'প্রশিক্ষণার্থী ও কোর্স ব্যবস্থাপনার সাথে সংশ্লিষ্টদের ব্যাগ',
                'sequence' => 7,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            19 => 
            array (
                'id' => 20,
                'tms_sector_id' => 3,
                'code' => '2005180754253502',
                'title_english' => 'Trainees Performance Award and Crest',
                'title_bangla' => 'প্রশিক্ষণার্থীদের পারফরমেন্স এওয়ার্ড ও ক্রেস্ট',
                'sequence' => 8,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            20 => 
            array (
                'id' => 21,
                'tms_sector_id' => 3,
                'code' => '2005180754258693',
            'title_english' => 'Sports & Physical Training (Sports & Recreation Utility Charges)',
            'title_bangla' => 'খেলাধুলা ও শরীর চর্চাসমূহ (ক্রীড়া ও বিনোদন ইউটিলিটি চার্জ)',
                'sequence' => 9,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            21 => 
            array (
                'id' => 22,
                'tms_sector_id' => 3,
                'code' => '2005180754255197',
                'title_english' => 'Competitive sports prizes and organizing expenses of the trainees',
                'title_bangla' => 'প্রশিক্ষণার্থীদের প্রতিযোগিতামূলক খেলাধুলার পুরষ্কার ও আয়োজন ব্যয়',
                'sequence' => 10,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            22 => 
            array (
                'id' => 23,
                'tms_sector_id' => 3,
                'code' => '2005180754257382',
                'title_english' => 'Published wall magazines and memoirs',
                'title_bangla' => 'দেয়াল পত্রিকা ও স্মরণিকা প্রকাশ',
                'sequence' => 11,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            23 => 
            array (
                'id' => 24,
                'tms_sector_id' => 3,
                'code' => '2005180754253780',
            'title_english' => 'Training materials (paper, pens, computer materials and training materials etc.)',
            'title_bangla' => 'প্রশিক্ষণ মনিহারী সামগ্রী (কাগজ, কলম, কম্পিউটার সামগ্রী ও প্রশিক্ষণ সামগ্রী  ইত্যাদি)',
                'sequence' => 12,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            24 => 
            array (
                'id' => 25,
                'tms_sector_id' => 3,
                'code' => '2005180754251615',
                'title_english' => 'Handbook and photocopy costs',
                'title_bangla' => 'হ্যান্ডবুক ও ফটোকপি ব্যয়',
                'sequence' => 13,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            25 => 
            array (
                'id' => 26,
                'tms_sector_id' => 3,
                'code' => '2005180754256726',
            'title_english' => 'Expenses for educational tours (including transportation and accommodation of trainees and guides)',
            'title_bangla' => 'শিক্ষা সফর ব্যয় (প্রশিক্ষণার্থী ও গাইডদের পরিবহন এবং আবাসনসহ)',
                'sequence' => 14,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            26 => 
            array (
                'id' => 27,
                'tms_sector_id' => 3,
                'code' => '2005180754256134',
            'title_english' => 'Practical Field Tour / Inspection Cost of Various Institutions (Transport and Fuel)',
            'title_bangla' => 'প্রায়োগিক মাঠ সফর/বিভিন্ন প্রতিষ্ঠান পরিদর্শন ব্যয় (পরিবহন ও জ্বালানী)',
                'sequence' => 15,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            27 => 
            array (
                'id' => 28,
                'tms_sector_id' => 3,
                'code' => '2005180754254125',
                'title_english' => 'Purchase of training and housing equipment',
                'title_bangla' => 'প্রশিক্ষণ ও আবাসন সরঞ্জামাদি ক্রয়',
                'sequence' => 16,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            28 => 
            array (
                'id' => 29,
                'tms_sector_id' => 3,
                'code' => '2005180754256398',
                'title_english' => 'Development of day-care centers and children\'s parks',
                'title_bangla' => 'ডে-কেয়ার সেন্টার ও শিশু পার্ক উন্নয়ন',
                'sequence' => 17,
                'details' => NULL,
                'created_at' => '2020-05-18 19:54:25',
                'updated_at' => '2020-05-18 19:54:25',
            ),
            29 => 
            array (
                'id' => 30,
                'tms_sector_id' => 4,
                'code' => '2005180801077603',
                'title_english' => 'Photography and video documentation',
                'title_bangla' => 'ফটোগ্রাফী ও ভিডিও ডকুমোন্টেশন',
                'sequence' => 6,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            30 => 
            array (
                'id' => 31,
                'tms_sector_id' => 4,
                'code' => '2005180801072731',
                'title_english' => 'Organization of examinations, evaluation of answer sheets and preparation of final report',
                'title_bangla' => 'পরীক্ষা সংগঠন, উত্তর পত্র মূল্যায়ন ও সমাপনী প্রতিবেদন প্রনয়ন',
                'sequence' => 7,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            31 => 
            array (
                'id' => 32,
                'tms_sector_id' => 4,
                'code' => '2005180801074973',
                'title_english' => 'Opening reception',
                'title_bangla' => 'উদ্বোধনী আপ্যায়ন',
                'sequence' => 8,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            32 => 
            array (
                'id' => 33,
                'tms_sector_id' => 4,
                'code' => '2005180801078412',
                'title_english' => 'Opening Reunion, Closing Dinner / DJ\'s, etc.',
                'title_bangla' => 'উদ্বোধনী আপ্যায়ন মধ্যবর্তী সম্মিলন, সমাপনী ডিনার/নৈশ ভোজ ও ডিজি’সটি ইত্যাদি',
                'sequence' => 9,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            33 => 
            array (
                'id' => 34,
                'tms_sector_id' => 4,
                'code' => '2005180801073230',
                'title_english' => 'Cost of course management and administrative support costs',
                'title_bangla' => 'কোর্স পরিচালনা/ব্যবস্থাপনা ও প্রশাসনিক সমর্থন ব্যয়',
                'sequence' => 10,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            34 => 
            array (
                'id' => 35,
                'tms_sector_id' => 4,
                'code' => '2005180801075892',
                'title_english' => 'Remuneration for secretarial and other assistance to employees',
                'title_bangla' => 'কর্মচারীদের সাচিবিক ও অন্যান্য সহায়তার জন্য পারিশ্রমিক',
                'sequence' => 11,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            35 => 
            array (
                'id' => 36,
                'tms_sector_id' => 4,
                'code' => '2005180801077280',
                'title_english' => 'Daily allowance of educational tour guides for trainees',
                'title_bangla' => 'প্রশিক্ষণার্থীদের শিক্ষা সফরের গাইডদের দৈনিক ভাতা',
                'sequence' => 12,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            36 => 
            array (
                'id' => 37,
                'tms_sector_id' => 4,
                'code' => '2005180801071686',
            'title_english' => 'Ancillary Expenses (TA of employees / officers, banners, cable TV charges, historical site inspection fees and others)',
            'title_bangla' => 'আনুষাঙ্গিঁক ব্যয় (কর্মচারী/কর্মকর্তাদের টিএ, ব্যানার, ক্যাবল টিভি চার্জ, ঐতিহাসিক স্থান পরিদর্শনের ফি ও অন্যান্য)',
                'sequence' => 13,
                'details' => NULL,
                'created_at' => '2020-05-18 20:01:07',
                'updated_at' => '2020-05-18 20:01:07',
            ),
            37 => 
            array (
                'id' => 38,
                'tms_sector_id' => 3,
                'code' => '2005180802387764',
                'title_english' => 'Paying daily wages',
                'title_bangla' => 'দৈনিক শ্রমিকের পারিশ্র্রমিক প্রদান',
                'sequence' => 18,
                'details' => NULL,
                'created_at' => '2020-05-18 20:02:38',
                'updated_at' => '2020-05-18 20:02:38',
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_user')->delete();
        
        \DB::table('role_user')->insert(array (
            0 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'user_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'role_id' => 2,
                'user_id' => 6,
                'created_at' => '2019-02-07 21:32:39',
                'updated_at' => '2019-02-07 21:32:39',
            ),
            2 => 
            array (
                'id' => 7,
                'role_id' => 5,
                'user_id' => 7,
                'created_at' => '2019-02-07 21:33:16',
                'updated_at' => '2019-02-07 21:33:16',
            ),
            3 => 
            array (
                'id' => 11,
                'role_id' => 6,
                'user_id' => 1,
                'created_at' => '2019-04-10 20:18:35',
                'updated_at' => '2019-04-10 20:18:35',
            ),
            4 => 
            array (
                'id' => 13,
                'role_id' => 7,
                'user_id' => 4,
                'created_at' => '2019-04-10 20:26:14',
                'updated_at' => '2019-04-10 20:26:14',
            ),
            5 => 
            array (
                'id' => 14,
                'role_id' => 1,
                'user_id' => 8,
                'created_at' => '2019-04-10 20:27:31',
                'updated_at' => '2019-04-10 20:27:31',
            ),
            6 => 
            array (
                'id' => 16,
                'role_id' => 2,
                'user_id' => 9,
                'created_at' => '2019-04-11 11:10:39',
                'updated_at' => '2019-04-11 11:10:39',
            ),
            7 => 
            array (
                'id' => 18,
                'role_id' => 4,
                'user_id' => 11,
                'created_at' => '2019-04-11 11:12:01',
                'updated_at' => '2019-04-11 11:12:01',
            ),
            8 => 
            array (
                'id' => 19,
                'role_id' => 5,
                'user_id' => 3,
                'created_at' => '2019-04-11 11:49:47',
                'updated_at' => '2019-04-11 11:49:47',
            ),
            9 => 
            array (
                'id' => 21,
                'role_id' => 5,
                'user_id' => 12,
                'created_at' => '2019-04-28 11:57:11',
                'updated_at' => '2019-04-28 11:57:11',
            ),
            10 => 
            array (
                'id' => 31,
                'role_id' => 6,
                'user_id' => 12,
                'created_at' => '2019-05-23 11:23:58',
                'updated_at' => '2019-05-23 11:23:58',
            ),
            11 => 
            array (
                'id' => 32,
                'role_id' => 6,
                'user_id' => 14,
                'created_at' => '2019-05-23 11:25:35',
                'updated_at' => '2019-05-23 11:25:35',
            ),
            12 => 
            array (
                'id' => 33,
                'role_id' => 6,
                'user_id' => 13,
                'created_at' => '2019-05-23 11:26:21',
                'updated_at' => '2019-05-23 11:26:21',
            ),
            13 => 
            array (
                'id' => 34,
                'role_id' => 6,
                'user_id' => 15,
                'created_at' => '2019-05-23 11:26:46',
                'updated_at' => '2019-05-23 11:26:46',
            ),
            14 => 
            array (
                'id' => 35,
                'role_id' => 6,
                'user_id' => 4,
                'created_at' => '2019-05-23 11:28:00',
                'updated_at' => '2019-05-23 11:28:00',
            ),
            15 => 
            array (
                'id' => 36,
                'role_id' => 6,
                'user_id' => 19,
                'created_at' => '2019-05-23 11:29:29',
                'updated_at' => '2019-05-23 11:29:29',
            ),
            16 => 
            array (
                'id' => 37,
                'role_id' => 8,
                'user_id' => 19,
                'created_at' => '2019-05-23 11:29:29',
                'updated_at' => '2019-05-23 11:29:29',
            ),
            17 => 
            array (
                'id' => 38,
                'role_id' => 6,
                'user_id' => 21,
                'created_at' => '2019-05-23 11:30:47',
                'updated_at' => '2019-05-23 11:30:47',
            ),
            18 => 
            array (
                'id' => 39,
                'role_id' => 6,
                'user_id' => 22,
                'created_at' => '2019-05-23 11:31:13',
                'updated_at' => '2019-05-23 11:31:13',
            ),
            19 => 
            array (
                'id' => 40,
                'role_id' => 6,
                'user_id' => 20,
                'created_at' => '2019-05-23 11:31:31',
                'updated_at' => '2019-05-23 11:31:31',
            ),
            20 => 
            array (
                'id' => 41,
                'role_id' => 4,
                'user_id' => 5,
                'created_at' => '2019-05-23 11:33:10',
                'updated_at' => '2019-05-23 11:33:10',
            ),
            21 => 
            array (
                'id' => 42,
                'role_id' => 6,
                'user_id' => 16,
                'created_at' => '2019-05-23 11:37:44',
                'updated_at' => '2019-05-23 11:37:44',
            ),
            22 => 
            array (
                'id' => 43,
                'role_id' => 6,
                'user_id' => 10,
                'created_at' => '2019-05-23 11:39:43',
                'updated_at' => '2019-05-23 11:39:43',
            ),
            23 => 
            array (
                'id' => 44,
                'role_id' => 6,
                'user_id' => 23,
                'created_at' => '2019-05-28 14:54:16',
                'updated_at' => '2019-05-28 14:54:16',
            ),
            24 => 
            array (
                'id' => 45,
                'role_id' => 6,
                'user_id' => 24,
                'created_at' => '2019-05-28 15:01:03',
                'updated_at' => '2019-05-28 15:01:03',
            ),
            25 => 
            array (
                'id' => 46,
                'role_id' => 6,
                'user_id' => 25,
                'created_at' => '2019-05-28 15:05:43',
                'updated_at' => '2019-05-28 15:05:43',
            ),
            26 => 
            array (
                'id' => 47,
                'role_id' => 6,
                'user_id' => 26,
                'created_at' => '2019-05-28 15:09:21',
                'updated_at' => '2019-05-28 15:09:21',
            ),
            27 => 
            array (
                'id' => 48,
                'role_id' => 6,
                'user_id' => 27,
                'created_at' => '2019-05-28 15:13:32',
                'updated_at' => '2019-05-28 15:13:32',
            ),
            28 => 
            array (
                'id' => 49,
                'role_id' => 6,
                'user_id' => 28,
                'created_at' => '2019-05-28 15:31:03',
                'updated_at' => '2019-05-28 15:31:03',
            ),
            29 => 
            array (
                'id' => 50,
                'role_id' => 6,
                'user_id' => 29,
                'created_at' => '2019-05-28 15:34:04',
                'updated_at' => '2019-05-28 15:34:04',
            ),
            30 => 
            array (
                'id' => 51,
                'role_id' => 6,
                'user_id' => 30,
                'created_at' => '2019-05-28 15:36:48',
                'updated_at' => '2019-05-28 15:36:48',
            ),
            31 => 
            array (
                'id' => 52,
                'role_id' => 6,
                'user_id' => 31,
                'created_at' => '2019-05-28 15:39:45',
                'updated_at' => '2019-05-28 15:39:45',
            ),
            32 => 
            array (
                'id' => 53,
                'role_id' => 6,
                'user_id' => 32,
                'created_at' => '2019-05-28 15:42:23',
                'updated_at' => '2019-05-28 15:42:23',
            ),
            33 => 
            array (
                'id' => 54,
                'role_id' => 6,
                'user_id' => 33,
                'created_at' => '2019-05-28 16:15:42',
                'updated_at' => '2019-05-28 16:15:42',
            ),
            34 => 
            array (
                'id' => 55,
                'role_id' => 6,
                'user_id' => 34,
                'created_at' => '2019-05-28 16:20:46',
                'updated_at' => '2019-05-28 16:20:46',
            ),
            35 => 
            array (
                'id' => 56,
                'role_id' => 6,
                'user_id' => 35,
                'created_at' => '2019-05-28 16:23:49',
                'updated_at' => '2019-05-28 16:23:49',
            ),
            36 => 
            array (
                'id' => 57,
                'role_id' => 6,
                'user_id' => 36,
                'created_at' => '2019-05-28 16:26:48',
                'updated_at' => '2019-05-28 16:26:48',
            ),
            37 => 
            array (
                'id' => 58,
                'role_id' => 6,
                'user_id' => 37,
                'created_at' => '2019-05-29 10:50:34',
                'updated_at' => '2019-05-29 10:50:34',
            ),
            38 => 
            array (
                'id' => 59,
                'role_id' => 6,
                'user_id' => 38,
                'created_at' => '2019-05-29 10:54:13',
                'updated_at' => '2019-05-29 10:54:13',
            ),
            39 => 
            array (
                'id' => 60,
                'role_id' => 6,
                'user_id' => 39,
                'created_at' => '2019-05-29 10:59:14',
                'updated_at' => '2019-05-29 10:59:14',
            ),
            40 => 
            array (
                'id' => 61,
                'role_id' => 6,
                'user_id' => 40,
                'created_at' => '2019-05-29 11:03:54',
                'updated_at' => '2019-05-29 11:03:54',
            ),
            41 => 
            array (
                'id' => 62,
                'role_id' => 6,
                'user_id' => 41,
                'created_at' => '2019-05-29 11:06:21',
                'updated_at' => '2019-05-29 11:06:21',
            ),
            42 => 
            array (
                'id' => 63,
                'role_id' => 6,
                'user_id' => 42,
                'created_at' => '2019-05-29 11:09:02',
                'updated_at' => '2019-05-29 11:09:02',
            ),
            43 => 
            array (
                'id' => 64,
                'role_id' => 6,
                'user_id' => 43,
                'created_at' => '2019-05-29 11:43:33',
                'updated_at' => '2019-05-29 11:43:33',
            ),
            44 => 
            array (
                'id' => 65,
                'role_id' => 6,
                'user_id' => 44,
                'created_at' => '2019-05-29 11:46:48',
                'updated_at' => '2019-05-29 11:46:48',
            ),
            45 => 
            array (
                'id' => 66,
                'role_id' => 6,
                'user_id' => 45,
                'created_at' => '2019-05-29 11:51:11',
                'updated_at' => '2019-05-29 11:51:11',
            ),
            46 => 
            array (
                'id' => 67,
                'role_id' => 6,
                'user_id' => 46,
                'created_at' => '2019-05-29 12:07:54',
                'updated_at' => '2019-05-29 12:07:54',
            ),
            47 => 
            array (
                'id' => 68,
                'role_id' => 6,
                'user_id' => 47,
                'created_at' => '2019-05-29 12:18:06',
                'updated_at' => '2019-05-29 12:18:06',
            ),
            48 => 
            array (
                'id' => 69,
                'role_id' => 6,
                'user_id' => 48,
                'created_at' => '2019-05-29 12:22:18',
                'updated_at' => '2019-05-29 12:22:18',
            ),
            49 => 
            array (
                'id' => 70,
                'role_id' => 6,
                'user_id' => 49,
                'created_at' => '2019-05-29 12:30:54',
                'updated_at' => '2019-05-29 12:30:54',
            ),
            50 => 
            array (
                'id' => 71,
                'role_id' => 6,
                'user_id' => 50,
                'created_at' => '2019-05-29 12:40:24',
                'updated_at' => '2019-05-29 12:40:24',
            ),
            51 => 
            array (
                'id' => 72,
                'role_id' => 6,
                'user_id' => 51,
                'created_at' => '2019-05-29 12:46:29',
                'updated_at' => '2019-05-29 12:46:29',
            ),
            52 => 
            array (
                'id' => 73,
                'role_id' => 6,
                'user_id' => 52,
                'created_at' => '2019-05-29 12:53:39',
                'updated_at' => '2019-05-29 12:53:39',
            ),
            53 => 
            array (
                'id' => 75,
                'role_id' => 10,
                'user_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 76,
                'role_id' => 6,
                'user_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 77,
                'role_id' => 10,
                'user_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 78,
                'role_id' => 6,
                'user_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 79,
                'role_id' => 10,
                'user_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 80,
                'role_id' => 10,
                'user_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 81,
                'role_id' => 6,
                'user_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 82,
                'role_id' => 10,
                'user_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 83,
                'role_id' => 6,
                'user_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 84,
                'role_id' => 10,
                'user_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 85,
                'role_id' => 6,
                'user_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 86,
                'role_id' => 10,
                'user_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 87,
                'role_id' => 12,
                'user_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 88,
                'role_id' => 11,
                'user_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 89,
                'role_id' => 13,
                'user_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 90,
                'role_id' => 6,
                'user_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 91,
                'role_id' => 10,
                'user_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 92,
                'role_id' => 9,
                'user_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 93,
                'role_id' => 12,
                'user_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 94,
                'role_id' => 11,
                'user_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 95,
                'role_id' => 13,
                'user_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 96,
                'role_id' => 6,
                'user_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 97,
                'role_id' => 10,
                'user_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 98,
                'role_id' => 10,
                'user_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 99,
                'role_id' => 6,
                'user_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 100,
                'role_id' => 10,
                'user_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 101,
                'role_id' => 9,
                'user_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 102,
                'role_id' => 12,
                'user_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 103,
                'role_id' => 10,
                'user_id' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 104,
                'role_id' => 10,
                'user_id' => 14,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 105,
                'role_id' => 10,
                'user_id' => 15,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 106,
                'role_id' => 10,
                'user_id' => 16,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 107,
                'role_id' => 10,
                'user_id' => 17,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 108,
                'role_id' => 6,
                'user_id' => 17,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 109,
                'role_id' => 10,
                'user_id' => 18,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 110,
                'role_id' => 6,
                'user_id' => 18,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 111,
                'role_id' => 10,
                'user_id' => 19,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 112,
                'role_id' => 10,
                'user_id' => 20,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 113,
                'role_id' => 10,
                'user_id' => 21,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 114,
                'role_id' => 10,
                'user_id' => 22,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 115,
                'role_id' => 10,
                'user_id' => 23,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 116,
                'role_id' => 10,
                'user_id' => 24,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 117,
                'role_id' => 10,
                'user_id' => 25,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 118,
                'role_id' => 10,
                'user_id' => 26,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 119,
                'role_id' => 10,
                'user_id' => 27,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 120,
                'role_id' => 10,
                'user_id' => 28,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 121,
                'role_id' => 10,
                'user_id' => 29,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 122,
                'role_id' => 10,
                'user_id' => 30,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 123,
                'role_id' => 10,
                'user_id' => 31,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 124,
                'role_id' => 10,
                'user_id' => 32,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 125,
                'role_id' => 10,
                'user_id' => 33,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 126,
                'role_id' => 10,
                'user_id' => 34,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 127,
                'role_id' => 10,
                'user_id' => 35,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 128,
                'role_id' => 10,
                'user_id' => 36,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 130,
                'role_id' => 10,
                'user_id' => 38,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 131,
                'role_id' => 10,
                'user_id' => 39,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 132,
                'role_id' => 10,
                'user_id' => 40,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 133,
                'role_id' => 10,
                'user_id' => 41,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 134,
                'role_id' => 10,
                'user_id' => 42,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 135,
                'role_id' => 10,
                'user_id' => 43,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 136,
                'role_id' => 10,
                'user_id' => 44,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 137,
                'role_id' => 10,
                'user_id' => 45,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 138,
                'role_id' => 10,
                'user_id' => 46,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 139,
                'role_id' => 10,
                'user_id' => 47,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 140,
                'role_id' => 10,
                'user_id' => 48,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 141,
                'role_id' => 10,
                'user_id' => 49,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'id' => 142,
                'role_id' => 10,
                'user_id' => 50,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'id' => 143,
                'role_id' => 9,
                'user_id' => 50,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 144,
                'role_id' => 12,
                'user_id' => 50,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 145,
                'role_id' => 10,
                'user_id' => 51,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'id' => 146,
                'role_id' => 10,
                'user_id' => 52,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'id' => 147,
                'role_id' => 10,
                'user_id' => 53,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'id' => 148,
                'role_id' => 6,
                'user_id' => 53,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'id' => 149,
                'role_id' => 10,
                'user_id' => 54,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 150,
                'role_id' => 12,
                'user_id' => 54,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'id' => 151,
                'role_id' => 11,
                'user_id' => 54,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 152,
                'role_id' => 13,
                'user_id' => 54,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'id' => 153,
                'role_id' => 14,
                'user_id' => 54,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'id' => 154,
                'role_id' => 6,
                'user_id' => 54,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'id' => 155,
                'role_id' => 10,
                'user_id' => 55,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'id' => 156,
                'role_id' => 12,
                'user_id' => 55,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'id' => 157,
                'role_id' => 11,
                'user_id' => 55,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'id' => 158,
                'role_id' => 13,
                'user_id' => 55,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'id' => 159,
                'role_id' => 14,
                'user_id' => 55,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'id' => 160,
                'role_id' => 6,
                'user_id' => 55,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'id' => 161,
                'role_id' => 7,
                'user_id' => 21,
                'created_at' => '2019-09-28 19:40:19',
                'updated_at' => '2019-09-28 19:40:19',
            ),
            139 => 
            array (
                'id' => 162,
                'role_id' => 1,
                'user_id' => 1,
                'created_at' => '2019-10-03 16:23:38',
                'updated_at' => '2019-10-03 16:23:38',
            ),
            140 => 
            array (
                'id' => 163,
                'role_id' => 2,
                'user_id' => 1,
                'created_at' => '2019-10-03 16:23:38',
                'updated_at' => '2019-10-03 16:23:38',
            ),
            141 => 
            array (
                'id' => 164,
                'role_id' => 5,
                'user_id' => 1,
                'created_at' => '2019-10-03 16:23:38',
                'updated_at' => '2019-10-03 16:23:38',
            ),
            142 => 
            array (
                'id' => 165,
                'role_id' => 1,
                'user_id' => 58,
                'created_at' => '2019-10-03 16:24:16',
                'updated_at' => '2019-10-03 16:24:16',
            ),
            143 => 
            array (
                'id' => 166,
                'role_id' => 2,
                'user_id' => 58,
                'created_at' => '2019-10-03 16:24:16',
                'updated_at' => '2019-10-03 16:24:16',
            ),
            144 => 
            array (
                'id' => 167,
                'role_id' => 5,
                'user_id' => 58,
                'created_at' => '2019-10-03 16:24:16',
                'updated_at' => '2019-10-03 16:24:16',
            ),
            145 => 
            array (
                'id' => 168,
                'role_id' => 6,
                'user_id' => 58,
                'created_at' => '2019-10-03 16:24:16',
                'updated_at' => '2019-10-03 16:24:16',
            ),
            146 => 
            array (
                'id' => 169,
                'role_id' => 2,
                'user_id' => 56,
                'created_at' => '2019-10-03 16:26:20',
                'updated_at' => '2019-10-03 16:26:20',
            ),
            147 => 
            array (
                'id' => 170,
                'role_id' => 2,
                'user_id' => 57,
                'created_at' => '2019-10-03 16:28:36',
                'updated_at' => '2019-10-03 16:28:36',
            ),
            148 => 
            array (
                'id' => 171,
                'role_id' => 10,
                'user_id' => 57,
                'created_at' => '2019-10-03 16:28:36',
                'updated_at' => '2019-10-03 16:28:36',
            ),
            149 => 
            array (
                'id' => 172,
                'role_id' => 10,
                'user_id' => 1,
                'created_at' => '2019-10-03 16:28:57',
                'updated_at' => '2019-10-03 16:28:57',
            ),
            150 => 
            array (
                'id' => 173,
                'role_id' => 10,
                'user_id' => 58,
                'created_at' => '2019-10-03 16:29:53',
                'updated_at' => '2019-10-03 16:29:53',
            ),
            151 => 
            array (
                'id' => 174,
                'role_id' => 10,
                'user_id' => 56,
                'created_at' => '2019-10-03 16:31:29',
                'updated_at' => '2019-10-03 16:31:29',
            ),
            152 => 
            array (
                'id' => 175,
                'role_id' => 11,
                'user_id' => 56,
                'created_at' => '2019-10-03 16:31:29',
                'updated_at' => '2019-10-03 16:31:29',
            ),
            153 => 
            array (
                'id' => 176,
                'role_id' => 12,
                'user_id' => 56,
                'created_at' => '2019-10-03 16:31:29',
                'updated_at' => '2019-10-03 16:31:29',
            ),
            154 => 
            array (
                'id' => 177,
                'role_id' => 1,
                'user_id' => 13,
                'created_at' => '2019-10-03 17:01:13',
                'updated_at' => '2019-10-03 17:01:13',
            ),
            155 => 
            array (
                'id' => 178,
                'role_id' => 2,
                'user_id' => 13,
                'created_at' => '2019-10-03 17:01:13',
                'updated_at' => '2019-10-03 17:01:13',
            ),
            156 => 
            array (
                'id' => 179,
                'role_id' => 5,
                'user_id' => 13,
                'created_at' => '2019-10-03 17:01:13',
                'updated_at' => '2019-10-03 17:01:13',
            ),
            157 => 
            array (
                'id' => 180,
                'role_id' => 6,
                'user_id' => 60,
                'created_at' => '2019-10-03 17:06:56',
                'updated_at' => '2019-10-03 17:06:56',
            ),
            158 => 
            array (
                'id' => 181,
                'role_id' => 10,
                'user_id' => 60,
                'created_at' => '2019-10-03 17:06:56',
                'updated_at' => '2019-10-03 17:06:56',
            ),
            159 => 
            array (
                'id' => 182,
                'role_id' => 3,
                'user_id' => 10,
                'created_at' => '2019-10-15 05:28:53',
                'updated_at' => '2019-10-15 05:28:53',
            ),
            160 => 
            array (
                'id' => 183,
                'role_id' => 3,
                'user_id' => 23,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            161 => 
            array (
                'id' => 184,
                'role_id' => 1,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            162 => 
            array (
                'id' => 185,
                'role_id' => 2,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            163 => 
            array (
                'id' => 186,
                'role_id' => 3,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            164 => 
            array (
                'id' => 187,
                'role_id' => 4,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            165 => 
            array (
                'id' => 188,
                'role_id' => 5,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            166 => 
            array (
                'id' => 189,
                'role_id' => 6,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            167 => 
            array (
                'id' => 190,
                'role_id' => 7,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            168 => 
            array (
                'id' => 191,
                'role_id' => 8,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            169 => 
            array (
                'id' => 192,
                'role_id' => 9,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            170 => 
            array (
                'id' => 193,
                'role_id' => 10,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            171 => 
            array (
                'id' => 194,
                'role_id' => 11,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            172 => 
            array (
                'id' => 195,
                'role_id' => 12,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            173 => 
            array (
                'id' => 196,
                'role_id' => 13,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            174 => 
            array (
                'id' => 197,
                'role_id' => 14,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            175 => 
            array (
                'id' => 198,
                'role_id' => 15,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            176 => 
            array (
                'id' => 199,
                'role_id' => 16,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            177 => 
            array (
                'id' => 200,
                'role_id' => 17,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            178 => 
            array (
                'id' => 201,
                'role_id' => 18,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            179 => 
            array (
                'id' => 202,
                'role_id' => 19,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
            180 => 
            array (
                'id' => 203,
                'role_id' => 20,
                'user_id' => 304,
                'created_at' => '2019-10-15 05:35:59',
                'updated_at' => '2019-10-15 05:35:59',
            ),
        ));
        
    }
}
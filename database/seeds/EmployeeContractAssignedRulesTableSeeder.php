<?php

use Illuminate\Database\Seeder;

class EmployeeContractAssignedRulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employee_contract_assigned_rules')->delete();
        
        \DB::table('employee_contract_assigned_rules')->insert(array (
            0 => 
            array (
                'id' => 1,
                'employee_contract_id' => 1,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2020-03-01 13:18:48',
            ),
            1 => 
            array (
                'id' => 2,
                'employee_contract_id' => 1,
                'salary_rule_id' => 4,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-13 15:14:37',
            ),
            2 => 
            array (
                'id' => 3,
                'employee_contract_id' => 1,
                'salary_rule_id' => 26,
                'amount' => 10050.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            3 => 
            array (
                'id' => 4,
                'employee_contract_id' => 1,
                'salary_rule_id' => 28,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            4 => 
            array (
                'id' => 5,
                'employee_contract_id' => 1,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            5 => 
            array (
                'id' => 6,
                'employee_contract_id' => 1,
                'salary_rule_id' => 6,
                'amount' => 6713.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            6 => 
            array (
                'id' => 7,
                'employee_contract_id' => 1,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            7 => 
            array (
                'id' => 8,
                'employee_contract_id' => 1,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            8 => 
            array (
                'id' => 9,
                'employee_contract_id' => 1,
                'salary_rule_id' => 9,
                'amount' => 40.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-13 15:14:37',
            ),
            9 => 
            array (
                'id' => 10,
                'employee_contract_id' => 1,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            10 => 
            array (
                'id' => 11,
                'employee_contract_id' => 1,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            11 => 
            array (
                'id' => 12,
                'employee_contract_id' => 1,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            12 => 
            array (
                'id' => 13,
                'employee_contract_id' => 1,
                'salary_rule_id' => 13,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-13 15:14:37',
            ),
            13 => 
            array (
                'id' => 14,
                'employee_contract_id' => 1,
                'salary_rule_id' => 14,
                'amount' => 3000.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            14 => 
            array (
                'id' => 15,
                'employee_contract_id' => 1,
                'salary_rule_id' => 15,
                'amount' => 600.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            15 => 
            array (
                'id' => 16,
                'employee_contract_id' => 1,
                'salary_rule_id' => 16,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            16 => 
            array (
                'id' => 17,
                'employee_contract_id' => 1,
                'salary_rule_id' => 17,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            17 => 
            array (
                'id' => 18,
                'employee_contract_id' => 1,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            18 => 
            array (
                'id' => 19,
                'employee_contract_id' => 1,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            19 => 
            array (
                'id' => 20,
                'employee_contract_id' => 1,
                'salary_rule_id' => 20,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            20 => 
            array (
                'id' => 21,
                'employee_contract_id' => 1,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-09 10:15:54',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            21 => 
            array (
                'id' => 22,
                'employee_contract_id' => 1,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2019-10-13 11:56:53',
                'updated_at' => '2019-10-23 10:29:53',
            ),
            22 => 
            array (
                'id' => 23,
                'employee_contract_id' => 2,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2020-03-01 13:18:48',
            ),
            23 => 
            array (
                'id' => 24,
                'employee_contract_id' => 2,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            24 => 
            array (
                'id' => 25,
                'employee_contract_id' => 2,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            25 => 
            array (
                'id' => 26,
                'employee_contract_id' => 2,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            26 => 
            array (
                'id' => 27,
                'employee_contract_id' => 2,
                'salary_rule_id' => 8,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            27 => 
            array (
                'id' => 28,
                'employee_contract_id' => 2,
                'salary_rule_id' => 9,
                'amount' => 40.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-15 12:47:36',
            ),
            28 => 
            array (
                'id' => 29,
                'employee_contract_id' => 2,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            29 => 
            array (
                'id' => 30,
                'employee_contract_id' => 2,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            30 => 
            array (
                'id' => 31,
                'employee_contract_id' => 2,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            31 => 
            array (
                'id' => 32,
                'employee_contract_id' => 2,
                'salary_rule_id' => 14,
                'amount' => 2000.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            32 => 
            array (
                'id' => 33,
                'employee_contract_id' => 2,
                'salary_rule_id' => 15,
                'amount' => 94.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            33 => 
            array (
                'id' => 34,
                'employee_contract_id' => 2,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            34 => 
            array (
                'id' => 35,
                'employee_contract_id' => 2,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            35 => 
            array (
                'id' => 36,
                'employee_contract_id' => 2,
                'salary_rule_id' => 18,
                'amount' => 4640.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            36 => 
            array (
                'id' => 37,
                'employee_contract_id' => 2,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            37 => 
            array (
                'id' => 38,
                'employee_contract_id' => 2,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            38 => 
            array (
                'id' => 39,
                'employee_contract_id' => 2,
                'salary_rule_id' => 21,
                'amount' => 360.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            39 => 
            array (
                'id' => 40,
                'employee_contract_id' => 2,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:47:36',
                'updated_at' => '2019-10-23 10:34:52',
            ),
            40 => 
            array (
                'id' => 41,
                'employee_contract_id' => 3,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2020-03-01 13:18:48',
            ),
            41 => 
            array (
                'id' => 42,
                'employee_contract_id' => 3,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            42 => 
            array (
                'id' => 43,
                'employee_contract_id' => 3,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            43 => 
            array (
                'id' => 44,
                'employee_contract_id' => 3,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            44 => 
            array (
                'id' => 45,
                'employee_contract_id' => 3,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            45 => 
            array (
                'id' => 46,
                'employee_contract_id' => 3,
                'salary_rule_id' => 9,
                'amount' => 40.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-15 13:01:42',
            ),
            46 => 
            array (
                'id' => 47,
                'employee_contract_id' => 3,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            47 => 
            array (
                'id' => 48,
                'employee_contract_id' => 3,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            48 => 
            array (
                'id' => 49,
                'employee_contract_id' => 3,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            49 => 
            array (
                'id' => 50,
                'employee_contract_id' => 3,
                'salary_rule_id' => 14,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            50 => 
            array (
                'id' => 51,
                'employee_contract_id' => 3,
                'salary_rule_id' => 15,
                'amount' => 408.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            51 => 
            array (
                'id' => 52,
                'employee_contract_id' => 3,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            52 => 
            array (
                'id' => 53,
                'employee_contract_id' => 3,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            53 => 
            array (
                'id' => 54,
                'employee_contract_id' => 3,
                'salary_rule_id' => 18,
                'amount' => 2000.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            54 => 
            array (
                'id' => 55,
                'employee_contract_id' => 3,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            55 => 
            array (
                'id' => 56,
                'employee_contract_id' => 3,
                'salary_rule_id' => 20,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            56 => 
            array (
                'id' => 57,
                'employee_contract_id' => 3,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            57 => 
            array (
                'id' => 58,
                'employee_contract_id' => 3,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 12:59:41',
                'updated_at' => '2019-10-23 10:36:02',
            ),
            58 => 
            array (
                'id' => 59,
                'employee_contract_id' => 4,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2020-03-01 13:18:48',
            ),
            59 => 
            array (
                'id' => 60,
                'employee_contract_id' => 4,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            60 => 
            array (
                'id' => 61,
                'employee_contract_id' => 4,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            61 => 
            array (
                'id' => 62,
                'employee_contract_id' => 4,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            62 => 
            array (
                'id' => 63,
                'employee_contract_id' => 4,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            63 => 
            array (
                'id' => 64,
                'employee_contract_id' => 4,
                'salary_rule_id' => 9,
                'amount' => 40.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-15 13:12:36',
            ),
            64 => 
            array (
                'id' => 65,
                'employee_contract_id' => 4,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            65 => 
            array (
                'id' => 66,
                'employee_contract_id' => 4,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            66 => 
            array (
                'id' => 67,
                'employee_contract_id' => 4,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            67 => 
            array (
                'id' => 68,
                'employee_contract_id' => 4,
                'salary_rule_id' => 14,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            68 => 
            array (
                'id' => 69,
                'employee_contract_id' => 4,
                'salary_rule_id' => 15,
                'amount' => 170.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            69 => 
            array (
                'id' => 70,
                'employee_contract_id' => 4,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            70 => 
            array (
                'id' => 71,
                'employee_contract_id' => 4,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            71 => 
            array (
                'id' => 72,
                'employee_contract_id' => 4,
                'salary_rule_id' => 18,
                'amount' => 5000.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            72 => 
            array (
                'id' => 73,
                'employee_contract_id' => 4,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            73 => 
            array (
                'id' => 74,
                'employee_contract_id' => 4,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            74 => 
            array (
                'id' => 75,
                'employee_contract_id' => 4,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            75 => 
            array (
                'id' => 76,
                'employee_contract_id' => 4,
                'salary_rule_id' => 34,
                'amount' => 15990.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:12:36',
                'updated_at' => '2019-10-23 10:37:02',
            ),
            76 => 
            array (
                'id' => 77,
                'employee_contract_id' => 5,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2020-03-01 13:18:48',
            ),
            77 => 
            array (
                'id' => 78,
                'employee_contract_id' => 5,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            78 => 
            array (
                'id' => 79,
                'employee_contract_id' => 5,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            79 => 
            array (
                'id' => 80,
                'employee_contract_id' => 5,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            80 => 
            array (
                'id' => 81,
                'employee_contract_id' => 5,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            81 => 
            array (
                'id' => 82,
                'employee_contract_id' => 5,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            82 => 
            array (
                'id' => 83,
                'employee_contract_id' => 5,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            83 => 
            array (
                'id' => 84,
                'employee_contract_id' => 5,
                'salary_rule_id' => 14,
                'amount' => 1500.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            84 => 
            array (
                'id' => 85,
                'employee_contract_id' => 5,
                'salary_rule_id' => 15,
                'amount' => 352.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            85 => 
            array (
                'id' => 86,
                'employee_contract_id' => 5,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            86 => 
            array (
                'id' => 87,
                'employee_contract_id' => 5,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            87 => 
            array (
                'id' => 88,
                'employee_contract_id' => 5,
                'salary_rule_id' => 18,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            88 => 
            array (
                'id' => 89,
                'employee_contract_id' => 5,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            89 => 
            array (
                'id' => 90,
                'employee_contract_id' => 5,
                'salary_rule_id' => 20,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            90 => 
            array (
                'id' => 91,
                'employee_contract_id' => 5,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            91 => 
            array (
                'id' => 92,
                'employee_contract_id' => 5,
                'salary_rule_id' => 34,
                'amount' => 16455.0,
                'remark' => NULL,
                'created_at' => '2019-10-15 13:29:38',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            92 => 
            array (
                'id' => 93,
                'employee_contract_id' => 6,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2020-03-01 13:18:48',
            ),
            93 => 
            array (
                'id' => 94,
                'employee_contract_id' => 6,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            94 => 
            array (
                'id' => 95,
                'employee_contract_id' => 6,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            95 => 
            array (
                'id' => 96,
                'employee_contract_id' => 6,
                'salary_rule_id' => 8,
                'amount' => 850.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            96 => 
            array (
                'id' => 97,
                'employee_contract_id' => 6,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            97 => 
            array (
                'id' => 98,
                'employee_contract_id' => 6,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            98 => 
            array (
                'id' => 99,
                'employee_contract_id' => 6,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            99 => 
            array (
                'id' => 100,
                'employee_contract_id' => 6,
                'salary_rule_id' => 14,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            100 => 
            array (
                'id' => 101,
                'employee_contract_id' => 6,
                'salary_rule_id' => 15,
                'amount' => 664.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            101 => 
            array (
                'id' => 102,
                'employee_contract_id' => 6,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            102 => 
            array (
                'id' => 103,
                'employee_contract_id' => 6,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            103 => 
            array (
                'id' => 104,
                'employee_contract_id' => 6,
                'salary_rule_id' => 18,
                'amount' => 3100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            104 => 
            array (
                'id' => 105,
                'employee_contract_id' => 6,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            105 => 
            array (
                'id' => 106,
                'employee_contract_id' => 6,
                'salary_rule_id' => 20,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            106 => 
            array (
                'id' => 107,
                'employee_contract_id' => 6,
                'salary_rule_id' => 21,
                'amount' => 120.0,
                'remark' => 'milk',
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            107 => 
            array (
                'id' => 108,
                'employee_contract_id' => 6,
                'salary_rule_id' => 34,
                'amount' => 15300.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:13:56',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            108 => 
            array (
                'id' => 109,
                'employee_contract_id' => 7,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2020-03-01 13:18:48',
            ),
            109 => 
            array (
                'id' => 110,
                'employee_contract_id' => 7,
                'salary_rule_id' => 6,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:30',
            ),
            110 => 
            array (
                'id' => 111,
                'employee_contract_id' => 7,
                'salary_rule_id' => 7,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            111 => 
            array (
                'id' => 112,
                'employee_contract_id' => 7,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            112 => 
            array (
                'id' => 113,
                'employee_contract_id' => 7,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            113 => 
            array (
                'id' => 114,
                'employee_contract_id' => 7,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            114 => 
            array (
                'id' => 115,
                'employee_contract_id' => 7,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            115 => 
            array (
                'id' => 116,
                'employee_contract_id' => 7,
                'salary_rule_id' => 14,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            116 => 
            array (
                'id' => 117,
                'employee_contract_id' => 7,
                'salary_rule_id' => 15,
                'amount' => 102.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            117 => 
            array (
                'id' => 118,
                'employee_contract_id' => 7,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            118 => 
            array (
                'id' => 119,
                'employee_contract_id' => 7,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            119 => 
            array (
                'id' => 120,
                'employee_contract_id' => 7,
                'salary_rule_id' => 18,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            120 => 
            array (
                'id' => 121,
                'employee_contract_id' => 7,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            121 => 
            array (
                'id' => 122,
                'employee_contract_id' => 7,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            122 => 
            array (
                'id' => 123,
                'employee_contract_id' => 7,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:31',
            ),
            123 => 
            array (
                'id' => 124,
                'employee_contract_id' => 7,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:26:39',
                'updated_at' => '2019-10-23 10:39:30',
            ),
            124 => 
            array (
                'id' => 125,
                'employee_contract_id' => 8,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            125 => 
            array (
                'id' => 126,
                'employee_contract_id' => 8,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            126 => 
            array (
                'id' => 127,
                'employee_contract_id' => 8,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            127 => 
            array (
                'id' => 128,
                'employee_contract_id' => 8,
                'salary_rule_id' => 8,
                'amount' => 3000.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            128 => 
            array (
                'id' => 129,
                'employee_contract_id' => 8,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            129 => 
            array (
                'id' => 130,
                'employee_contract_id' => 8,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            130 => 
            array (
                'id' => 131,
                'employee_contract_id' => 8,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            131 => 
            array (
                'id' => 132,
                'employee_contract_id' => 8,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            132 => 
            array (
                'id' => 133,
                'employee_contract_id' => 8,
                'salary_rule_id' => 15,
                'amount' => 718.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            133 => 
            array (
                'id' => 134,
                'employee_contract_id' => 8,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            134 => 
            array (
                'id' => 135,
                'employee_contract_id' => 8,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            135 => 
            array (
                'id' => 136,
                'employee_contract_id' => 8,
                'salary_rule_id' => 18,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            136 => 
            array (
                'id' => 137,
                'employee_contract_id' => 8,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            137 => 
            array (
                'id' => 138,
                'employee_contract_id' => 8,
                'salary_rule_id' => 20,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            138 => 
            array (
                'id' => 139,
                'employee_contract_id' => 8,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:50',
            ),
            139 => 
            array (
                'id' => 140,
                'employee_contract_id' => 8,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 11:58:13',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            140 => 
            array (
                'id' => 141,
                'employee_contract_id' => 9,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            141 => 
            array (
                'id' => 142,
                'employee_contract_id' => 9,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            142 => 
            array (
                'id' => 143,
                'employee_contract_id' => 9,
                'salary_rule_id' => 7,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            143 => 
            array (
                'id' => 144,
                'employee_contract_id' => 9,
                'salary_rule_id' => 8,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            144 => 
            array (
                'id' => 145,
                'employee_contract_id' => 9,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            145 => 
            array (
                'id' => 146,
                'employee_contract_id' => 9,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            146 => 
            array (
                'id' => 147,
                'employee_contract_id' => 9,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            147 => 
            array (
                'id' => 148,
                'employee_contract_id' => 9,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            148 => 
            array (
                'id' => 149,
                'employee_contract_id' => 9,
                'salary_rule_id' => 15,
                'amount' => 104.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            149 => 
            array (
                'id' => 150,
                'employee_contract_id' => 9,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            150 => 
            array (
                'id' => 151,
                'employee_contract_id' => 9,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            151 => 
            array (
                'id' => 152,
                'employee_contract_id' => 9,
                'salary_rule_id' => 18,
                'amount' => 310.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            152 => 
            array (
                'id' => 153,
                'employee_contract_id' => 9,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            153 => 
            array (
                'id' => 154,
                'employee_contract_id' => 9,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            154 => 
            array (
                'id' => 155,
                'employee_contract_id' => 9,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            155 => 
            array (
                'id' => 156,
                'employee_contract_id' => 9,
                'salary_rule_id' => 34,
                'amount' => 15300.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 12:09:30',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            156 => 
            array (
                'id' => 157,
                'employee_contract_id' => 9,
                'salary_rule_id' => 24,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 14:26:53',
                'updated_at' => '2019-10-23 10:40:14',
            ),
            157 => 
            array (
                'id' => 158,
                'employee_contract_id' => 8,
                'salary_rule_id' => 24,
                'amount' => 1500.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:40:51',
                'updated_at' => '2019-10-23 10:39:49',
            ),
            158 => 
            array (
                'id' => 159,
                'employee_contract_id' => 7,
                'salary_rule_id' => 24,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:42:33',
                'updated_at' => '2019-10-23 10:39:30',
            ),
            159 => 
            array (
                'id' => 160,
                'employee_contract_id' => 10,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            160 => 
            array (
                'id' => 161,
                'employee_contract_id' => 10,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            161 => 
            array (
                'id' => 162,
                'employee_contract_id' => 10,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            162 => 
            array (
                'id' => 163,
                'employee_contract_id' => 10,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            163 => 
            array (
                'id' => 164,
                'employee_contract_id' => 10,
                'salary_rule_id' => 8,
                'amount' => 850.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            164 => 
            array (
                'id' => 165,
                'employee_contract_id' => 10,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            165 => 
            array (
                'id' => 166,
                'employee_contract_id' => 10,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            166 => 
            array (
                'id' => 167,
                'employee_contract_id' => 10,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            167 => 
            array (
                'id' => 168,
                'employee_contract_id' => 10,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            168 => 
            array (
                'id' => 169,
                'employee_contract_id' => 10,
                'salary_rule_id' => 15,
                'amount' => 598.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            169 => 
            array (
                'id' => 170,
                'employee_contract_id' => 10,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            170 => 
            array (
                'id' => 171,
                'employee_contract_id' => 10,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            171 => 
            array (
                'id' => 172,
                'employee_contract_id' => 10,
                'salary_rule_id' => 18,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            172 => 
            array (
                'id' => 173,
                'employee_contract_id' => 10,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            173 => 
            array (
                'id' => 174,
                'employee_contract_id' => 10,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            174 => 
            array (
                'id' => 175,
                'employee_contract_id' => 10,
                'salary_rule_id' => 21,
                'amount' => 120.0,
                'remark' => 'milk',
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            175 => 
            array (
                'id' => 176,
                'employee_contract_id' => 10,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-16 15:45:39',
                'updated_at' => '2019-10-23 10:40:35',
            ),
            176 => 
            array (
                'id' => 177,
                'employee_contract_id' => 11,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            177 => 
            array (
                'id' => 178,
                'employee_contract_id' => 11,
                'salary_rule_id' => 5,
                'amount' => 4000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            178 => 
            array (
                'id' => 179,
                'employee_contract_id' => 11,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            179 => 
            array (
                'id' => 180,
                'employee_contract_id' => 11,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            180 => 
            array (
                'id' => 181,
                'employee_contract_id' => 11,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            181 => 
            array (
                'id' => 182,
                'employee_contract_id' => 11,
                'salary_rule_id' => 10,
                'amount' => 5355.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            182 => 
            array (
                'id' => 183,
                'employee_contract_id' => 11,
                'salary_rule_id' => 11,
                'amount' => 325.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            183 => 
            array (
                'id' => 184,
                'employee_contract_id' => 11,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            184 => 
            array (
                'id' => 185,
                'employee_contract_id' => 11,
                'salary_rule_id' => 14,
                'amount' => 1500.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            185 => 
            array (
                'id' => 186,
                'employee_contract_id' => 11,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            186 => 
            array (
                'id' => 187,
                'employee_contract_id' => 11,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            187 => 
            array (
                'id' => 188,
                'employee_contract_id' => 11,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            188 => 
            array (
                'id' => 189,
                'employee_contract_id' => 11,
                'salary_rule_id' => 18,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            189 => 
            array (
                'id' => 190,
                'employee_contract_id' => 11,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            190 => 
            array (
                'id' => 191,
                'employee_contract_id' => 11,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            191 => 
            array (
                'id' => 192,
                'employee_contract_id' => 11,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            192 => 
            array (
                'id' => 193,
                'employee_contract_id' => 11,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:42:43',
                'updated_at' => '2019-10-23 11:03:18',
            ),
            193 => 
            array (
                'id' => 194,
                'employee_contract_id' => 12,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            194 => 
            array (
                'id' => 195,
                'employee_contract_id' => 12,
                'salary_rule_id' => 5,
                'amount' => 6000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            195 => 
            array (
                'id' => 196,
                'employee_contract_id' => 12,
                'salary_rule_id' => 6,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            196 => 
            array (
                'id' => 197,
                'employee_contract_id' => 12,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            197 => 
            array (
                'id' => 198,
                'employee_contract_id' => 12,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            198 => 
            array (
                'id' => 199,
                'employee_contract_id' => 12,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            199 => 
            array (
                'id' => 200,
                'employee_contract_id' => 12,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            200 => 
            array (
                'id' => 201,
                'employee_contract_id' => 12,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            201 => 
            array (
                'id' => 202,
                'employee_contract_id' => 12,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            202 => 
            array (
                'id' => 203,
                'employee_contract_id' => 12,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            203 => 
            array (
                'id' => 204,
                'employee_contract_id' => 12,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            204 => 
            array (
                'id' => 205,
                'employee_contract_id' => 12,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            205 => 
            array (
                'id' => 206,
                'employee_contract_id' => 12,
                'salary_rule_id' => 18,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            206 => 
            array (
                'id' => 207,
                'employee_contract_id' => 12,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            207 => 
            array (
                'id' => 208,
                'employee_contract_id' => 12,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            208 => 
            array (
                'id' => 209,
                'employee_contract_id' => 12,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            209 => 
            array (
                'id' => 210,
                'employee_contract_id' => 12,
                'salary_rule_id' => 34,
                'amount' => 15990.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 10:50:58',
                'updated_at' => '2019-10-23 11:19:51',
            ),
            210 => 
            array (
                'id' => 211,
                'employee_contract_id' => 13,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            211 => 
            array (
                'id' => 212,
                'employee_contract_id' => 13,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            212 => 
            array (
                'id' => 213,
                'employee_contract_id' => 13,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            213 => 
            array (
                'id' => 214,
                'employee_contract_id' => 13,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            214 => 
            array (
                'id' => 215,
                'employee_contract_id' => 13,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            215 => 
            array (
                'id' => 216,
                'employee_contract_id' => 13,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            216 => 
            array (
                'id' => 217,
                'employee_contract_id' => 13,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            217 => 
            array (
                'id' => 218,
                'employee_contract_id' => 13,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            218 => 
            array (
                'id' => 219,
                'employee_contract_id' => 13,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            219 => 
            array (
                'id' => 220,
                'employee_contract_id' => 13,
                'salary_rule_id' => 15,
                'amount' => 418.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            220 => 
            array (
                'id' => 221,
                'employee_contract_id' => 13,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            221 => 
            array (
                'id' => 222,
                'employee_contract_id' => 13,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            222 => 
            array (
                'id' => 223,
                'employee_contract_id' => 13,
                'salary_rule_id' => 18,
                'amount' => 1491.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            223 => 
            array (
                'id' => 224,
                'employee_contract_id' => 13,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            224 => 
            array (
                'id' => 225,
                'employee_contract_id' => 13,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            225 => 
            array (
                'id' => 226,
                'employee_contract_id' => 13,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            226 => 
            array (
                'id' => 227,
                'employee_contract_id' => 13,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:14:55',
                'updated_at' => '2019-10-23 11:20:17',
            ),
            227 => 
            array (
                'id' => 228,
                'employee_contract_id' => 14,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            228 => 
            array (
                'id' => 229,
                'employee_contract_id' => 14,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            229 => 
            array (
                'id' => 230,
                'employee_contract_id' => 14,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            230 => 
            array (
                'id' => 231,
                'employee_contract_id' => 14,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            231 => 
            array (
                'id' => 232,
                'employee_contract_id' => 14,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            232 => 
            array (
                'id' => 233,
                'employee_contract_id' => 14,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            233 => 
            array (
                'id' => 234,
                'employee_contract_id' => 14,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            234 => 
            array (
                'id' => 235,
                'employee_contract_id' => 14,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            235 => 
            array (
                'id' => 236,
                'employee_contract_id' => 14,
                'salary_rule_id' => 14,
                'amount' => 700.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            236 => 
            array (
                'id' => 237,
                'employee_contract_id' => 14,
                'salary_rule_id' => 15,
                'amount' => 132.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            237 => 
            array (
                'id' => 238,
                'employee_contract_id' => 14,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            238 => 
            array (
                'id' => 239,
                'employee_contract_id' => 14,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            239 => 
            array (
                'id' => 240,
                'employee_contract_id' => 14,
                'salary_rule_id' => 18,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            240 => 
            array (
                'id' => 241,
                'employee_contract_id' => 14,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            241 => 
            array (
                'id' => 242,
                'employee_contract_id' => 14,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            242 => 
            array (
                'id' => 243,
                'employee_contract_id' => 14,
                'salary_rule_id' => 21,
                'amount' => 300.0,
                'remark' => 'milk',
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            243 => 
            array (
                'id' => 244,
                'employee_contract_id' => 14,
                'salary_rule_id' => 34,
                'amount' => 15990.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:22:22',
                'updated_at' => '2019-10-23 11:20:42',
            ),
            244 => 
            array (
                'id' => 245,
                'employee_contract_id' => 15,
                'salary_rule_id' => 34,
                'amount' => 12656.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            245 => 
            array (
                'id' => 246,
                'employee_contract_id' => 15,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            246 => 
            array (
                'id' => 247,
                'employee_contract_id' => 15,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            247 => 
            array (
                'id' => 248,
                'employee_contract_id' => 15,
                'salary_rule_id' => 7,
                'amount' => 2000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            248 => 
            array (
                'id' => 249,
                'employee_contract_id' => 15,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            249 => 
            array (
                'id' => 250,
                'employee_contract_id' => 15,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            250 => 
            array (
                'id' => 251,
                'employee_contract_id' => 15,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            251 => 
            array (
                'id' => 252,
                'employee_contract_id' => 15,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            252 => 
            array (
                'id' => 253,
                'employee_contract_id' => 15,
                'salary_rule_id' => 14,
                'amount' => 2000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            253 => 
            array (
                'id' => 254,
                'employee_contract_id' => 15,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            254 => 
            array (
                'id' => 255,
                'employee_contract_id' => 15,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            255 => 
            array (
                'id' => 256,
                'employee_contract_id' => 15,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            256 => 
            array (
                'id' => 257,
                'employee_contract_id' => 15,
                'salary_rule_id' => 18,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            257 => 
            array (
                'id' => 258,
                'employee_contract_id' => 15,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            258 => 
            array (
                'id' => 259,
                'employee_contract_id' => 15,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            259 => 
            array (
                'id' => 260,
                'employee_contract_id' => 15,
                'salary_rule_id' => 21,
                'amount' => 1080.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            260 => 
            array (
                'id' => 261,
                'employee_contract_id' => 15,
                'salary_rule_id' => 34,
                'amount' => 12656.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:36:05',
                'updated_at' => '2019-10-23 11:21:10',
            ),
            261 => 
            array (
                'id' => 262,
                'employee_contract_id' => 16,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            262 => 
            array (
                'id' => 263,
                'employee_contract_id' => 16,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            263 => 
            array (
                'id' => 264,
                'employee_contract_id' => 16,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            264 => 
            array (
                'id' => 265,
                'employee_contract_id' => 16,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            265 => 
            array (
                'id' => 266,
                'employee_contract_id' => 16,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            266 => 
            array (
                'id' => 267,
                'employee_contract_id' => 16,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            267 => 
            array (
                'id' => 268,
                'employee_contract_id' => 16,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            268 => 
            array (
                'id' => 269,
                'employee_contract_id' => 16,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            269 => 
            array (
                'id' => 270,
                'employee_contract_id' => 16,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            270 => 
            array (
                'id' => 271,
                'employee_contract_id' => 16,
                'salary_rule_id' => 15,
                'amount' => 172.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            271 => 
            array (
                'id' => 272,
                'employee_contract_id' => 16,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            272 => 
            array (
                'id' => 273,
                'employee_contract_id' => 16,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            273 => 
            array (
                'id' => 274,
                'employee_contract_id' => 16,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            274 => 
            array (
                'id' => 275,
                'employee_contract_id' => 16,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            275 => 
            array (
                'id' => 276,
                'employee_contract_id' => 16,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            276 => 
            array (
                'id' => 277,
                'employee_contract_id' => 16,
                'salary_rule_id' => 21,
                'amount' => 420.0,
                'remark' => 'milk',
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            277 => 
            array (
                'id' => 278,
                'employee_contract_id' => 16,
                'salary_rule_id' => 34,
                'amount' => 17115.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 11:40:28',
                'updated_at' => '2019-10-23 11:21:34',
            ),
            278 => 
            array (
                'id' => 279,
                'employee_contract_id' => 17,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            279 => 
            array (
                'id' => 280,
                'employee_contract_id' => 17,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            280 => 
            array (
                'id' => 281,
                'employee_contract_id' => 17,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            281 => 
            array (
                'id' => 282,
                'employee_contract_id' => 17,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            282 => 
            array (
                'id' => 283,
                'employee_contract_id' => 17,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            283 => 
            array (
                'id' => 284,
                'employee_contract_id' => 17,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            284 => 
            array (
                'id' => 285,
                'employee_contract_id' => 17,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            285 => 
            array (
                'id' => 286,
                'employee_contract_id' => 17,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            286 => 
            array (
                'id' => 287,
                'employee_contract_id' => 17,
                'salary_rule_id' => 14,
                'amount' => 2500.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            287 => 
            array (
                'id' => 288,
                'employee_contract_id' => 17,
                'salary_rule_id' => 15,
                'amount' => 428.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            288 => 
            array (
                'id' => 289,
                'employee_contract_id' => 17,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            289 => 
            array (
                'id' => 290,
                'employee_contract_id' => 17,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            290 => 
            array (
                'id' => 291,
                'employee_contract_id' => 17,
                'salary_rule_id' => 18,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            291 => 
            array (
                'id' => 292,
                'employee_contract_id' => 17,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            292 => 
            array (
                'id' => 293,
                'employee_contract_id' => 17,
                'salary_rule_id' => 20,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            293 => 
            array (
                'id' => 294,
                'employee_contract_id' => 17,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            294 => 
            array (
                'id' => 295,
                'employee_contract_id' => 17,
                'salary_rule_id' => 34,
                'amount' => 13692.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:23:04',
                'updated_at' => '2019-10-23 11:22:03',
            ),
            295 => 
            array (
                'id' => 296,
                'employee_contract_id' => 18,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            296 => 
            array (
                'id' => 297,
                'employee_contract_id' => 18,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            297 => 
            array (
                'id' => 298,
                'employee_contract_id' => 18,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            298 => 
            array (
                'id' => 299,
                'employee_contract_id' => 18,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            299 => 
            array (
                'id' => 300,
                'employee_contract_id' => 18,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            300 => 
            array (
                'id' => 301,
                'employee_contract_id' => 18,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            301 => 
            array (
                'id' => 302,
                'employee_contract_id' => 18,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            302 => 
            array (
                'id' => 303,
                'employee_contract_id' => 18,
                'salary_rule_id' => 12,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            303 => 
            array (
                'id' => 304,
                'employee_contract_id' => 18,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            304 => 
            array (
                'id' => 305,
                'employee_contract_id' => 18,
                'salary_rule_id' => 15,
                'amount' => 1500.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            305 => 
            array (
                'id' => 306,
                'employee_contract_id' => 18,
                'salary_rule_id' => 16,
                'amount' => 420.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            306 => 
            array (
                'id' => 307,
                'employee_contract_id' => 18,
                'salary_rule_id' => 17,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            307 => 
            array (
                'id' => 308,
                'employee_contract_id' => 18,
                'salary_rule_id' => 18,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            308 => 
            array (
                'id' => 309,
                'employee_contract_id' => 18,
                'salary_rule_id' => 19,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            309 => 
            array (
                'id' => 310,
                'employee_contract_id' => 18,
                'salary_rule_id' => 20,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            310 => 
            array (
                'id' => 311,
                'employee_contract_id' => 18,
                'salary_rule_id' => 21,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            311 => 
            array (
                'id' => 312,
                'employee_contract_id' => 18,
                'salary_rule_id' => 34,
                'amount' => 10269.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:41:16',
                'updated_at' => '2019-10-23 11:19:22',
            ),
            312 => 
            array (
                'id' => 313,
                'employee_contract_id' => 19,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            313 => 
            array (
                'id' => 314,
                'employee_contract_id' => 19,
                'salary_rule_id' => 5,
                'amount' => 10000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:22',
            ),
            314 => 
            array (
                'id' => 315,
                'employee_contract_id' => 19,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:22',
            ),
            315 => 
            array (
                'id' => 316,
                'employee_contract_id' => 19,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:22',
            ),
            316 => 
            array (
                'id' => 317,
                'employee_contract_id' => 19,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:22',
            ),
            317 => 
            array (
                'id' => 318,
                'employee_contract_id' => 19,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:22',
            ),
            318 => 
            array (
                'id' => 319,
                'employee_contract_id' => 19,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            319 => 
            array (
                'id' => 320,
                'employee_contract_id' => 19,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            320 => 
            array (
                'id' => 321,
                'employee_contract_id' => 19,
                'salary_rule_id' => 14,
                'amount' => 2500.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            321 => 
            array (
                'id' => 322,
                'employee_contract_id' => 19,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            322 => 
            array (
                'id' => 323,
                'employee_contract_id' => 19,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            323 => 
            array (
                'id' => 324,
                'employee_contract_id' => 19,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            324 => 
            array (
                'id' => 325,
                'employee_contract_id' => 19,
                'salary_rule_id' => 18,
                'amount' => 5000.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            325 => 
            array (
                'id' => 326,
                'employee_contract_id' => 19,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            326 => 
            array (
                'id' => 327,
                'employee_contract_id' => 19,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            327 => 
            array (
                'id' => 328,
                'employee_contract_id' => 19,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:23',
            ),
            328 => 
            array (
                'id' => 329,
                'employee_contract_id' => 19,
                'salary_rule_id' => 34,
                'amount' => 14240.0,
                'remark' => NULL,
                'created_at' => '2019-10-17 12:43:44',
                'updated_at' => '2019-10-23 11:22:22',
            ),
            329 => 
            array (
                'id' => 330,
                'employee_contract_id' => 20,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            330 => 
            array (
                'id' => 331,
                'employee_contract_id' => 20,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            331 => 
            array (
                'id' => 332,
                'employee_contract_id' => 20,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            332 => 
            array (
                'id' => 333,
                'employee_contract_id' => 20,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            333 => 
            array (
                'id' => 334,
                'employee_contract_id' => 20,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            334 => 
            array (
                'id' => 335,
                'employee_contract_id' => 20,
                'salary_rule_id' => 10,
                'amount' => 3777.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            335 => 
            array (
                'id' => 336,
                'employee_contract_id' => 20,
                'salary_rule_id' => 11,
                'amount' => 244.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            336 => 
            array (
                'id' => 337,
                'employee_contract_id' => 20,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            337 => 
            array (
                'id' => 338,
                'employee_contract_id' => 20,
                'salary_rule_id' => 14,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            338 => 
            array (
                'id' => 339,
                'employee_contract_id' => 20,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            339 => 
            array (
                'id' => 340,
                'employee_contract_id' => 20,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            340 => 
            array (
                'id' => 341,
                'employee_contract_id' => 20,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            341 => 
            array (
                'id' => 342,
                'employee_contract_id' => 20,
                'salary_rule_id' => 18,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            342 => 
            array (
                'id' => 343,
                'employee_contract_id' => 20,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            343 => 
            array (
                'id' => 344,
                'employee_contract_id' => 20,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            344 => 
            array (
                'id' => 345,
                'employee_contract_id' => 20,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            345 => 
            array (
                'id' => 346,
                'employee_contract_id' => 20,
                'salary_rule_id' => 34,
                'amount' => 6475.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:29:03',
                'updated_at' => '2019-10-23 11:22:43',
            ),
            346 => 
            array (
                'id' => 347,
                'employee_contract_id' => 21,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2020-03-01 13:18:49',
            ),
            347 => 
            array (
                'id' => 348,
                'employee_contract_id' => 21,
                'salary_rule_id' => 5,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            348 => 
            array (
                'id' => 349,
                'employee_contract_id' => 21,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            349 => 
            array (
                'id' => 350,
                'employee_contract_id' => 21,
                'salary_rule_id' => 7,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            350 => 
            array (
                'id' => 351,
                'employee_contract_id' => 21,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            351 => 
            array (
                'id' => 352,
                'employee_contract_id' => 21,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            352 => 
            array (
                'id' => 353,
                'employee_contract_id' => 21,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            353 => 
            array (
                'id' => 354,
                'employee_contract_id' => 21,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            354 => 
            array (
                'id' => 355,
                'employee_contract_id' => 21,
                'salary_rule_id' => 14,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            355 => 
            array (
                'id' => 356,
                'employee_contract_id' => 21,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            356 => 
            array (
                'id' => 357,
                'employee_contract_id' => 21,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            357 => 
            array (
                'id' => 358,
                'employee_contract_id' => 21,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            358 => 
            array (
                'id' => 359,
                'employee_contract_id' => 21,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            359 => 
            array (
                'id' => 360,
                'employee_contract_id' => 21,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            360 => 
            array (
                'id' => 361,
                'employee_contract_id' => 21,
                'salary_rule_id' => 20,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            361 => 
            array (
                'id' => 362,
                'employee_contract_id' => 21,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            362 => 
            array (
                'id' => 363,
                'employee_contract_id' => 21,
                'salary_rule_id' => 34,
                'amount' => 6475.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:47:09',
                'updated_at' => '2019-10-22 17:24:50',
            ),
            363 => 
            array (
                'id' => 364,
                'employee_contract_id' => 22,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            364 => 
            array (
                'id' => 365,
                'employee_contract_id' => 22,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            365 => 
            array (
                'id' => 366,
                'employee_contract_id' => 22,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            366 => 
            array (
                'id' => 367,
                'employee_contract_id' => 22,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            367 => 
            array (
                'id' => 368,
                'employee_contract_id' => 22,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            368 => 
            array (
                'id' => 369,
                'employee_contract_id' => 22,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            369 => 
            array (
                'id' => 370,
                'employee_contract_id' => 22,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            370 => 
            array (
                'id' => 371,
                'employee_contract_id' => 22,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            371 => 
            array (
                'id' => 372,
                'employee_contract_id' => 22,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            372 => 
            array (
                'id' => 373,
                'employee_contract_id' => 22,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            373 => 
            array (
                'id' => 374,
                'employee_contract_id' => 22,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            374 => 
            array (
                'id' => 375,
                'employee_contract_id' => 22,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            375 => 
            array (
                'id' => 376,
                'employee_contract_id' => 22,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            376 => 
            array (
                'id' => 377,
                'employee_contract_id' => 22,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            377 => 
            array (
                'id' => 378,
                'employee_contract_id' => 22,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            378 => 
            array (
                'id' => 379,
                'employee_contract_id' => 22,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            379 => 
            array (
                'id' => 380,
                'employee_contract_id' => 22,
                'salary_rule_id' => 34,
                'amount' => 10792.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:50:11',
                'updated_at' => '2019-10-22 17:25:38',
            ),
            380 => 
            array (
                'id' => 381,
                'employee_contract_id' => 23,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            381 => 
            array (
                'id' => 382,
                'employee_contract_id' => 23,
                'salary_rule_id' => 5,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:13',
            ),
            382 => 
            array (
                'id' => 383,
                'employee_contract_id' => 23,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:13',
            ),
            383 => 
            array (
                'id' => 384,
                'employee_contract_id' => 23,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            384 => 
            array (
                'id' => 385,
                'employee_contract_id' => 23,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            385 => 
            array (
                'id' => 386,
                'employee_contract_id' => 23,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            386 => 
            array (
                'id' => 387,
                'employee_contract_id' => 23,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            387 => 
            array (
                'id' => 388,
                'employee_contract_id' => 23,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            388 => 
            array (
                'id' => 389,
                'employee_contract_id' => 23,
                'salary_rule_id' => 14,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            389 => 
            array (
                'id' => 390,
                'employee_contract_id' => 23,
                'salary_rule_id' => 15,
                'amount' => 190.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            390 => 
            array (
                'id' => 391,
                'employee_contract_id' => 23,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            391 => 
            array (
                'id' => 392,
                'employee_contract_id' => 23,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            392 => 
            array (
                'id' => 393,
                'employee_contract_id' => 23,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            393 => 
            array (
                'id' => 394,
                'employee_contract_id' => 23,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            394 => 
            array (
                'id' => 395,
                'employee_contract_id' => 23,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            395 => 
            array (
                'id' => 396,
                'employee_contract_id' => 23,
                'salary_rule_id' => 21,
                'amount' => 1680.0,
                'remark' => 'milk',
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:14',
            ),
            396 => 
            array (
                'id' => 397,
                'employee_contract_id' => 23,
                'salary_rule_id' => 34,
                'amount' => 9520.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 11:55:21',
                'updated_at' => '2019-10-22 17:25:13',
            ),
            397 => 
            array (
                'id' => 398,
                'employee_contract_id' => 24,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            398 => 
            array (
                'id' => 399,
                'employee_contract_id' => 24,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            399 => 
            array (
                'id' => 400,
                'employee_contract_id' => 24,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            400 => 
            array (
                'id' => 401,
                'employee_contract_id' => 24,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            401 => 
            array (
                'id' => 402,
                'employee_contract_id' => 24,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            402 => 
            array (
                'id' => 403,
                'employee_contract_id' => 24,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            403 => 
            array (
                'id' => 404,
                'employee_contract_id' => 24,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            404 => 
            array (
                'id' => 405,
                'employee_contract_id' => 24,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            405 => 
            array (
                'id' => 406,
                'employee_contract_id' => 24,
                'salary_rule_id' => 14,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            406 => 
            array (
                'id' => 407,
                'employee_contract_id' => 24,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            407 => 
            array (
                'id' => 408,
                'employee_contract_id' => 24,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            408 => 
            array (
                'id' => 409,
                'employee_contract_id' => 24,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            409 => 
            array (
                'id' => 410,
                'employee_contract_id' => 24,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            410 => 
            array (
                'id' => 411,
                'employee_contract_id' => 24,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            411 => 
            array (
                'id' => 412,
                'employee_contract_id' => 24,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            412 => 
            array (
                'id' => 413,
                'employee_contract_id' => 24,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            413 => 
            array (
                'id' => 414,
                'employee_contract_id' => 24,
                'salary_rule_id' => 34,
                'amount' => 14007.0,
                'remark' => NULL,
                'created_at' => '2019-10-20 12:01:05',
                'updated_at' => '2019-10-22 17:24:01',
            ),
            414 => 
            array (
                'id' => 415,
                'employee_contract_id' => 25,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            415 => 
            array (
                'id' => 416,
                'employee_contract_id' => 25,
                'salary_rule_id' => 5,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            416 => 
            array (
                'id' => 417,
                'employee_contract_id' => 25,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            417 => 
            array (
                'id' => 418,
                'employee_contract_id' => 25,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            418 => 
            array (
                'id' => 419,
                'employee_contract_id' => 25,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            419 => 
            array (
                'id' => 420,
                'employee_contract_id' => 25,
                'salary_rule_id' => 10,
                'amount' => 2810.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            420 => 
            array (
                'id' => 421,
                'employee_contract_id' => 25,
                'salary_rule_id' => 11,
                'amount' => 244.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            421 => 
            array (
                'id' => 422,
                'employee_contract_id' => 25,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            422 => 
            array (
                'id' => 423,
                'employee_contract_id' => 25,
                'salary_rule_id' => 14,
                'amount' => 250.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            423 => 
            array (
                'id' => 424,
                'employee_contract_id' => 25,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            424 => 
            array (
                'id' => 425,
                'employee_contract_id' => 25,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            425 => 
            array (
                'id' => 426,
                'employee_contract_id' => 25,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            426 => 
            array (
                'id' => 427,
                'employee_contract_id' => 25,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            427 => 
            array (
                'id' => 428,
                'employee_contract_id' => 25,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            428 => 
            array (
                'id' => 429,
                'employee_contract_id' => 25,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            429 => 
            array (
                'id' => 430,
                'employee_contract_id' => 25,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            430 => 
            array (
                'id' => 431,
                'employee_contract_id' => 25,
                'salary_rule_id' => 34,
                'amount' => 7025.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 12:26:24',
                'updated_at' => '2019-10-23 11:23:09',
            ),
            431 => 
            array (
                'id' => 432,
                'employee_contract_id' => 26,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            432 => 
            array (
                'id' => 433,
                'employee_contract_id' => 26,
                'salary_rule_id' => 5,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            433 => 
            array (
                'id' => 434,
                'employee_contract_id' => 26,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            434 => 
            array (
                'id' => 435,
                'employee_contract_id' => 26,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            435 => 
            array (
                'id' => 436,
                'employee_contract_id' => 26,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            436 => 
            array (
                'id' => 437,
                'employee_contract_id' => 26,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            437 => 
            array (
                'id' => 438,
                'employee_contract_id' => 26,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            438 => 
            array (
                'id' => 439,
                'employee_contract_id' => 26,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            439 => 
            array (
                'id' => 440,
                'employee_contract_id' => 26,
                'salary_rule_id' => 14,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            440 => 
            array (
                'id' => 441,
                'employee_contract_id' => 26,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            441 => 
            array (
                'id' => 442,
                'employee_contract_id' => 26,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            442 => 
            array (
                'id' => 443,
                'employee_contract_id' => 26,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            443 => 
            array (
                'id' => 444,
                'employee_contract_id' => 26,
                'salary_rule_id' => 18,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            444 => 
            array (
                'id' => 445,
                'employee_contract_id' => 26,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            445 => 
            array (
                'id' => 446,
                'employee_contract_id' => 26,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            446 => 
            array (
                'id' => 447,
                'employee_contract_id' => 26,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            447 => 
            array (
                'id' => 448,
                'employee_contract_id' => 26,
                'salary_rule_id' => 34,
                'amount' => 5902.0,
                'remark' => '20%',
                'created_at' => '2019-10-21 12:47:34',
                'updated_at' => '2019-10-23 11:23:45',
            ),
            448 => 
            array (
                'id' => 449,
                'employee_contract_id' => 27,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            449 => 
            array (
                'id' => 450,
                'employee_contract_id' => 27,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            450 => 
            array (
                'id' => 451,
                'employee_contract_id' => 27,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            451 => 
            array (
                'id' => 452,
                'employee_contract_id' => 27,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            452 => 
            array (
                'id' => 453,
                'employee_contract_id' => 27,
                'salary_rule_id' => 8,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            453 => 
            array (
                'id' => 454,
                'employee_contract_id' => 27,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            454 => 
            array (
                'id' => 455,
                'employee_contract_id' => 27,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            455 => 
            array (
                'id' => 456,
                'employee_contract_id' => 27,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            456 => 
            array (
                'id' => 457,
                'employee_contract_id' => 27,
                'salary_rule_id' => 14,
                'amount' => 400.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            457 => 
            array (
                'id' => 458,
                'employee_contract_id' => 27,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            458 => 
            array (
                'id' => 459,
                'employee_contract_id' => 27,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            459 => 
            array (
                'id' => 460,
                'employee_contract_id' => 27,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            460 => 
            array (
                'id' => 461,
                'employee_contract_id' => 27,
                'salary_rule_id' => 18,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            461 => 
            array (
                'id' => 462,
                'employee_contract_id' => 27,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            462 => 
            array (
                'id' => 463,
                'employee_contract_id' => 27,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            463 => 
            array (
                'id' => 464,
                'employee_contract_id' => 27,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            464 => 
            array (
                'id' => 465,
                'employee_contract_id' => 27,
                'salary_rule_id' => 34,
                'amount' => 9000.0,
                'remark' => '20%',
                'created_at' => '2019-10-21 12:53:19',
                'updated_at' => '2019-10-23 11:24:13',
            ),
            465 => 
            array (
                'id' => 466,
                'employee_contract_id' => 28,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            466 => 
            array (
                'id' => 467,
                'employee_contract_id' => 28,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            467 => 
            array (
                'id' => 468,
                'employee_contract_id' => 28,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            468 => 
            array (
                'id' => 469,
                'employee_contract_id' => 28,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            469 => 
            array (
                'id' => 470,
                'employee_contract_id' => 28,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            470 => 
            array (
                'id' => 471,
                'employee_contract_id' => 28,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            471 => 
            array (
                'id' => 472,
                'employee_contract_id' => 28,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            472 => 
            array (
                'id' => 473,
                'employee_contract_id' => 28,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            473 => 
            array (
                'id' => 474,
                'employee_contract_id' => 28,
                'salary_rule_id' => 14,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            474 => 
            array (
                'id' => 475,
                'employee_contract_id' => 28,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            475 => 
            array (
                'id' => 476,
                'employee_contract_id' => 28,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            476 => 
            array (
                'id' => 477,
                'employee_contract_id' => 28,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            477 => 
            array (
                'id' => 478,
                'employee_contract_id' => 28,
                'salary_rule_id' => 18,
                'amount' => 5000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            478 => 
            array (
                'id' => 479,
                'employee_contract_id' => 28,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            479 => 
            array (
                'id' => 480,
                'employee_contract_id' => 28,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            480 => 
            array (
                'id' => 481,
                'employee_contract_id' => 28,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            481 => 
            array (
                'id' => 482,
                'employee_contract_id' => 28,
                'salary_rule_id' => 34,
                'amount' => 10200.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:00:18',
                'updated_at' => '2019-10-23 11:24:46',
            ),
            482 => 
            array (
                'id' => 483,
                'employee_contract_id' => 29,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            483 => 
            array (
                'id' => 484,
                'employee_contract_id' => 29,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            484 => 
            array (
                'id' => 485,
                'employee_contract_id' => 29,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            485 => 
            array (
                'id' => 486,
                'employee_contract_id' => 29,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            486 => 
            array (
                'id' => 487,
                'employee_contract_id' => 29,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            487 => 
            array (
                'id' => 488,
                'employee_contract_id' => 29,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            488 => 
            array (
                'id' => 489,
                'employee_contract_id' => 29,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            489 => 
            array (
                'id' => 490,
                'employee_contract_id' => 29,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            490 => 
            array (
                'id' => 491,
                'employee_contract_id' => 29,
                'salary_rule_id' => 14,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            491 => 
            array (
                'id' => 492,
                'employee_contract_id' => 29,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            492 => 
            array (
                'id' => 493,
                'employee_contract_id' => 29,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            493 => 
            array (
                'id' => 494,
                'employee_contract_id' => 29,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            494 => 
            array (
                'id' => 495,
                'employee_contract_id' => 29,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            495 => 
            array (
                'id' => 496,
                'employee_contract_id' => 29,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            496 => 
            array (
                'id' => 497,
                'employee_contract_id' => 29,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:20',
            ),
            497 => 
            array (
                'id' => 498,
                'employee_contract_id' => 29,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:20',
            ),
            498 => 
            array (
                'id' => 499,
                'employee_contract_id' => 29,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 13:11:12',
                'updated_at' => '2019-10-23 10:41:19',
            ),
            499 => 
            array (
                'id' => 500,
                'employee_contract_id' => 30,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2020-03-01 13:18:50',
            ),
        ));
        \DB::table('employee_contract_assigned_rules')->insert(array (
            0 => 
            array (
                'id' => 501,
                'employee_contract_id' => 30,
                'salary_rule_id' => 24,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            1 => 
            array (
                'id' => 502,
                'employee_contract_id' => 30,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            2 => 
            array (
                'id' => 503,
                'employee_contract_id' => 30,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            3 => 
            array (
                'id' => 504,
                'employee_contract_id' => 30,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-21 13:15:06',
            ),
            4 => 
            array (
                'id' => 505,
                'employee_contract_id' => 30,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            5 => 
            array (
                'id' => 506,
                'employee_contract_id' => 30,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            6 => 
            array (
                'id' => 507,
                'employee_contract_id' => 30,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            7 => 
            array (
                'id' => 508,
                'employee_contract_id' => 30,
                'salary_rule_id' => 12,
                'amount' => 2242.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            8 => 
            array (
                'id' => 509,
                'employee_contract_id' => 30,
                'salary_rule_id' => 14,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            9 => 
            array (
                'id' => 510,
                'employee_contract_id' => 30,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            10 => 
            array (
                'id' => 511,
                'employee_contract_id' => 30,
                'salary_rule_id' => 16,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-21 13:15:06',
            ),
            11 => 
            array (
                'id' => 512,
                'employee_contract_id' => 30,
                'salary_rule_id' => 17,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-21 13:15:06',
            ),
            12 => 
            array (
                'id' => 513,
                'employee_contract_id' => 30,
                'salary_rule_id' => 18,
                'amount' => 240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            13 => 
            array (
                'id' => 514,
                'employee_contract_id' => 30,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            14 => 
            array (
                'id' => 515,
                'employee_contract_id' => 30,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            15 => 
            array (
                'id' => 516,
                'employee_contract_id' => 30,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            16 => 
            array (
                'id' => 517,
                'employee_contract_id' => 30,
                'salary_rule_id' => 34,
                'amount' => 6857.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 13:15:06',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            17 => 
            array (
                'id' => 518,
                'employee_contract_id' => 31,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            18 => 
            array (
                'id' => 519,
                'employee_contract_id' => 31,
                'salary_rule_id' => 5,
                'amount' => 3000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            19 => 
            array (
                'id' => 520,
                'employee_contract_id' => 31,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            20 => 
            array (
                'id' => 521,
                'employee_contract_id' => 31,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            21 => 
            array (
                'id' => 522,
                'employee_contract_id' => 31,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            22 => 
            array (
                'id' => 523,
                'employee_contract_id' => 31,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            23 => 
            array (
                'id' => 524,
                'employee_contract_id' => 31,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            24 => 
            array (
                'id' => 525,
                'employee_contract_id' => 31,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            25 => 
            array (
                'id' => 526,
                'employee_contract_id' => 31,
                'salary_rule_id' => 14,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            26 => 
            array (
                'id' => 527,
                'employee_contract_id' => 31,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            27 => 
            array (
                'id' => 528,
                'employee_contract_id' => 31,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            28 => 
            array (
                'id' => 529,
                'employee_contract_id' => 31,
                'salary_rule_id' => 17,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            29 => 
            array (
                'id' => 530,
                'employee_contract_id' => 31,
                'salary_rule_id' => 18,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            30 => 
            array (
                'id' => 531,
                'employee_contract_id' => 31,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            31 => 
            array (
                'id' => 532,
                'employee_contract_id' => 31,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            32 => 
            array (
                'id' => 533,
                'employee_contract_id' => 31,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            33 => 
            array (
                'id' => 534,
                'employee_contract_id' => 31,
                'salary_rule_id' => 34,
                'amount' => 6212.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 13:42:28',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            34 => 
            array (
                'id' => 535,
                'employee_contract_id' => 31,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 13:48:56',
                'updated_at' => '2019-10-21 13:53:37',
            ),
            35 => 
            array (
                'id' => 536,
                'employee_contract_id' => 32,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2020-03-01 13:18:50',
            ),
            36 => 
            array (
                'id' => 537,
                'employee_contract_id' => 32,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            37 => 
            array (
                'id' => 538,
                'employee_contract_id' => 32,
                'salary_rule_id' => 5,
                'amount' => 4000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            38 => 
            array (
                'id' => 539,
                'employee_contract_id' => 32,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            39 => 
            array (
                'id' => 540,
                'employee_contract_id' => 32,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            40 => 
            array (
                'id' => 541,
                'employee_contract_id' => 32,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            41 => 
            array (
                'id' => 542,
                'employee_contract_id' => 32,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            42 => 
            array (
                'id' => 543,
                'employee_contract_id' => 32,
                'salary_rule_id' => 11,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            43 => 
            array (
                'id' => 544,
                'employee_contract_id' => 32,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            44 => 
            array (
                'id' => 545,
                'employee_contract_id' => 32,
                'salary_rule_id' => 14,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            45 => 
            array (
                'id' => 546,
                'employee_contract_id' => 32,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            46 => 
            array (
                'id' => 547,
                'employee_contract_id' => 32,
                'salary_rule_id' => 16,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            47 => 
            array (
                'id' => 548,
                'employee_contract_id' => 32,
                'salary_rule_id' => 17,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            48 => 
            array (
                'id' => 549,
                'employee_contract_id' => 32,
                'salary_rule_id' => 18,
                'amount' => 500.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            49 => 
            array (
                'id' => 550,
                'employee_contract_id' => 32,
                'salary_rule_id' => 19,
                'amount' => 640.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            50 => 
            array (
                'id' => 551,
                'employee_contract_id' => 32,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            51 => 
            array (
                'id' => 552,
                'employee_contract_id' => 32,
                'salary_rule_id' => 21,
                'amount' => 660.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            52 => 
            array (
                'id' => 553,
                'employee_contract_id' => 32,
                'salary_rule_id' => 34,
                'amount' => 5900.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 14:50:38',
                'updated_at' => '2019-10-21 14:50:38',
            ),
            53 => 
            array (
                'id' => 554,
                'employee_contract_id' => 33,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            54 => 
            array (
                'id' => 555,
                'employee_contract_id' => 33,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            55 => 
            array (
                'id' => 556,
                'employee_contract_id' => 33,
                'salary_rule_id' => 37,
                'amount' => 4000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            56 => 
            array (
                'id' => 557,
                'employee_contract_id' => 33,
                'salary_rule_id' => 5,
                'amount' => 3000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            57 => 
            array (
                'id' => 558,
                'employee_contract_id' => 33,
                'salary_rule_id' => 6,
                'amount' => 1300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            58 => 
            array (
                'id' => 559,
                'employee_contract_id' => 33,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 15:41:54',
            ),
            59 => 
            array (
                'id' => 560,
                'employee_contract_id' => 33,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            60 => 
            array (
                'id' => 561,
                'employee_contract_id' => 33,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            61 => 
            array (
                'id' => 562,
                'employee_contract_id' => 33,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            62 => 
            array (
                'id' => 563,
                'employee_contract_id' => 33,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            63 => 
            array (
                'id' => 564,
                'employee_contract_id' => 33,
                'salary_rule_id' => 14,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            64 => 
            array (
                'id' => 565,
                'employee_contract_id' => 33,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            65 => 
            array (
                'id' => 566,
                'employee_contract_id' => 33,
                'salary_rule_id' => 16,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 15:41:54',
            ),
            66 => 
            array (
                'id' => 567,
                'employee_contract_id' => 33,
                'salary_rule_id' => 17,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 15:41:54',
            ),
            67 => 
            array (
                'id' => 568,
                'employee_contract_id' => 33,
                'salary_rule_id' => 18,
                'amount' => 14952.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            68 => 
            array (
                'id' => 569,
                'employee_contract_id' => 33,
                'salary_rule_id' => 19,
                'amount' => 700.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            69 => 
            array (
                'id' => 570,
                'employee_contract_id' => 33,
                'salary_rule_id' => 20,
                'amount' => 30.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            70 => 
            array (
                'id' => 571,
                'employee_contract_id' => 33,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            71 => 
            array (
                'id' => 572,
                'employee_contract_id' => 33,
                'salary_rule_id' => 34,
                'amount' => 6190.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 15:34:11',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            72 => 
            array (
                'id' => 573,
                'employee_contract_id' => 33,
                'salary_rule_id' => 24,
                'amount' => 1250.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 15:40:41',
                'updated_at' => '2019-10-21 16:30:13',
            ),
            73 => 
            array (
                'id' => 574,
                'employee_contract_id' => 34,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            74 => 
            array (
                'id' => 575,
                'employee_contract_id' => 34,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            75 => 
            array (
                'id' => 576,
                'employee_contract_id' => 34,
                'salary_rule_id' => 24,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            76 => 
            array (
                'id' => 577,
                'employee_contract_id' => 34,
                'salary_rule_id' => 34,
                'amount' => 2887.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            77 => 
            array (
                'id' => 578,
                'employee_contract_id' => 34,
                'salary_rule_id' => 5,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            78 => 
            array (
                'id' => 579,
                'employee_contract_id' => 34,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            79 => 
            array (
                'id' => 580,
                'employee_contract_id' => 34,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            80 => 
            array (
                'id' => 581,
                'employee_contract_id' => 34,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            81 => 
            array (
                'id' => 582,
                'employee_contract_id' => 34,
                'salary_rule_id' => 11,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            82 => 
            array (
                'id' => 583,
                'employee_contract_id' => 34,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            83 => 
            array (
                'id' => 584,
                'employee_contract_id' => 34,
                'salary_rule_id' => 14,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            84 => 
            array (
                'id' => 585,
                'employee_contract_id' => 34,
                'salary_rule_id' => 15,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            85 => 
            array (
                'id' => 586,
                'employee_contract_id' => 34,
                'salary_rule_id' => 18,
                'amount' => 540.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            86 => 
            array (
                'id' => 587,
                'employee_contract_id' => 34,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            87 => 
            array (
                'id' => 588,
                'employee_contract_id' => 34,
                'salary_rule_id' => 20,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            88 => 
            array (
                'id' => 589,
                'employee_contract_id' => 34,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:01:18',
                'updated_at' => '2019-10-21 17:01:18',
            ),
            89 => 
            array (
                'id' => 590,
                'employee_contract_id' => 35,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            90 => 
            array (
                'id' => 591,
                'employee_contract_id' => 35,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            91 => 
            array (
                'id' => 592,
                'employee_contract_id' => 35,
                'salary_rule_id' => 24,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            92 => 
            array (
                'id' => 593,
                'employee_contract_id' => 35,
                'salary_rule_id' => 34,
                'amount' => 3176.0,
                'remark' => '20%',
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            93 => 
            array (
                'id' => 594,
                'employee_contract_id' => 35,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            94 => 
            array (
                'id' => 595,
                'employee_contract_id' => 35,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            95 => 
            array (
                'id' => 596,
                'employee_contract_id' => 35,
                'salary_rule_id' => 8,
                'amount' => 1700.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            96 => 
            array (
                'id' => 597,
                'employee_contract_id' => 35,
                'salary_rule_id' => 10,
                'amount' => 3573.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            97 => 
            array (
                'id' => 598,
                'employee_contract_id' => 35,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            98 => 
            array (
                'id' => 599,
                'employee_contract_id' => 35,
                'salary_rule_id' => 12,
                'amount' => 1348.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            99 => 
            array (
                'id' => 600,
                'employee_contract_id' => 35,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            100 => 
            array (
                'id' => 601,
                'employee_contract_id' => 35,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            101 => 
            array (
                'id' => 602,
                'employee_contract_id' => 35,
                'salary_rule_id' => 18,
                'amount' => 540.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            102 => 
            array (
                'id' => 603,
                'employee_contract_id' => 35,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            103 => 
            array (
                'id' => 604,
                'employee_contract_id' => 35,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            104 => 
            array (
                'id' => 605,
                'employee_contract_id' => 35,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:07:48',
                'updated_at' => '2019-10-21 17:07:48',
            ),
            105 => 
            array (
                'id' => 606,
                'employee_contract_id' => 36,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            106 => 
            array (
                'id' => 607,
                'employee_contract_id' => 36,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            107 => 
            array (
                'id' => 608,
                'employee_contract_id' => 36,
                'salary_rule_id' => 24,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            108 => 
            array (
                'id' => 609,
                'employee_contract_id' => 36,
                'salary_rule_id' => 34,
                'amount' => 3970.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            109 => 
            array (
                'id' => 610,
                'employee_contract_id' => 36,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            110 => 
            array (
                'id' => 611,
                'employee_contract_id' => 36,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            111 => 
            array (
                'id' => 612,
                'employee_contract_id' => 36,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            112 => 
            array (
                'id' => 613,
                'employee_contract_id' => 36,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            113 => 
            array (
                'id' => 614,
                'employee_contract_id' => 36,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            114 => 
            array (
                'id' => 615,
                'employee_contract_id' => 36,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            115 => 
            array (
                'id' => 616,
                'employee_contract_id' => 36,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            116 => 
            array (
                'id' => 617,
                'employee_contract_id' => 36,
                'salary_rule_id' => 15,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            117 => 
            array (
                'id' => 618,
                'employee_contract_id' => 36,
                'salary_rule_id' => 18,
                'amount' => 240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            118 => 
            array (
                'id' => 619,
                'employee_contract_id' => 36,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:58',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            119 => 
            array (
                'id' => 620,
                'employee_contract_id' => 36,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:59',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            120 => 
            array (
                'id' => 621,
                'employee_contract_id' => 36,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:38:59',
                'updated_at' => '2019-10-27 13:18:36',
            ),
            121 => 
            array (
                'id' => 622,
                'employee_contract_id' => 37,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:01',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            122 => 
            array (
                'id' => 623,
                'employee_contract_id' => 37,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            123 => 
            array (
                'id' => 624,
                'employee_contract_id' => 37,
                'salary_rule_id' => 36,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            124 => 
            array (
                'id' => 625,
                'employee_contract_id' => 37,
                'salary_rule_id' => 34,
                'amount' => 970.0,
                'remark' => '10%',
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            125 => 
            array (
                'id' => 626,
                'employee_contract_id' => 37,
                'salary_rule_id' => 5,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            126 => 
            array (
                'id' => 627,
                'employee_contract_id' => 37,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            127 => 
            array (
                'id' => 628,
                'employee_contract_id' => 37,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            128 => 
            array (
                'id' => 629,
                'employee_contract_id' => 37,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            129 => 
            array (
                'id' => 630,
                'employee_contract_id' => 37,
                'salary_rule_id' => 11,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            130 => 
            array (
                'id' => 631,
                'employee_contract_id' => 37,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            131 => 
            array (
                'id' => 632,
                'employee_contract_id' => 37,
                'salary_rule_id' => 14,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            132 => 
            array (
                'id' => 633,
                'employee_contract_id' => 37,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            133 => 
            array (
                'id' => 634,
                'employee_contract_id' => 37,
                'salary_rule_id' => 18,
                'amount' => 2040.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            134 => 
            array (
                'id' => 635,
                'employee_contract_id' => 37,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            135 => 
            array (
                'id' => 636,
                'employee_contract_id' => 37,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            136 => 
            array (
                'id' => 637,
                'employee_contract_id' => 37,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 17:44:02',
                'updated_at' => '2019-10-21 17:44:02',
            ),
            137 => 
            array (
                'id' => 638,
                'employee_contract_id' => 38,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            138 => 
            array (
                'id' => 639,
                'employee_contract_id' => 38,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            139 => 
            array (
                'id' => 640,
                'employee_contract_id' => 38,
                'salary_rule_id' => 36,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            140 => 
            array (
                'id' => 641,
                'employee_contract_id' => 38,
                'salary_rule_id' => 34,
                'amount' => 900.0,
                'remark' => '10%',
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            141 => 
            array (
                'id' => 642,
                'employee_contract_id' => 38,
                'salary_rule_id' => 5,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            142 => 
            array (
                'id' => 643,
                'employee_contract_id' => 38,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            143 => 
            array (
                'id' => 644,
                'employee_contract_id' => 38,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            144 => 
            array (
                'id' => 645,
                'employee_contract_id' => 38,
                'salary_rule_id' => 10,
                'amount' => 4500.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            145 => 
            array (
                'id' => 646,
                'employee_contract_id' => 38,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            146 => 
            array (
                'id' => 647,
                'employee_contract_id' => 38,
                'salary_rule_id' => 12,
                'amount' => 1049.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            147 => 
            array (
                'id' => 648,
                'employee_contract_id' => 38,
                'salary_rule_id' => 14,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            148 => 
            array (
                'id' => 649,
                'employee_contract_id' => 38,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            149 => 
            array (
                'id' => 650,
                'employee_contract_id' => 38,
                'salary_rule_id' => 18,
                'amount' => 830.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            150 => 
            array (
                'id' => 651,
                'employee_contract_id' => 38,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            151 => 
            array (
                'id' => 652,
                'employee_contract_id' => 38,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            152 => 
            array (
                'id' => 653,
                'employee_contract_id' => 38,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:16:45',
                'updated_at' => '2019-10-21 18:16:45',
            ),
            153 => 
            array (
                'id' => 654,
                'employee_contract_id' => 39,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            154 => 
            array (
                'id' => 655,
                'employee_contract_id' => 39,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            155 => 
            array (
                'id' => 656,
                'employee_contract_id' => 39,
                'salary_rule_id' => 36,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            156 => 
            array (
                'id' => 657,
                'employee_contract_id' => 39,
                'salary_rule_id' => 34,
                'amount' => 900.0,
                'remark' => '10%',
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            157 => 
            array (
                'id' => 658,
                'employee_contract_id' => 39,
                'salary_rule_id' => 5,
                'amount' => 1500.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            158 => 
            array (
                'id' => 659,
                'employee_contract_id' => 39,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            159 => 
            array (
                'id' => 660,
                'employee_contract_id' => 39,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            160 => 
            array (
                'id' => 661,
                'employee_contract_id' => 39,
                'salary_rule_id' => 10,
                'amount' => 4500.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            161 => 
            array (
                'id' => 662,
                'employee_contract_id' => 39,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            162 => 
            array (
                'id' => 663,
                'employee_contract_id' => 39,
                'salary_rule_id' => 12,
                'amount' => 1451.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            163 => 
            array (
                'id' => 664,
                'employee_contract_id' => 39,
                'salary_rule_id' => 14,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            164 => 
            array (
                'id' => 665,
                'employee_contract_id' => 39,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            165 => 
            array (
                'id' => 666,
                'employee_contract_id' => 39,
                'salary_rule_id' => 18,
                'amount' => 7983.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            166 => 
            array (
                'id' => 667,
                'employee_contract_id' => 39,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            167 => 
            array (
                'id' => 668,
                'employee_contract_id' => 39,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            168 => 
            array (
                'id' => 669,
                'employee_contract_id' => 39,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:24:48',
                'updated_at' => '2019-10-21 18:24:48',
            ),
            169 => 
            array (
                'id' => 670,
                'employee_contract_id' => 40,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            170 => 
            array (
                'id' => 671,
                'employee_contract_id' => 40,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            171 => 
            array (
                'id' => 672,
                'employee_contract_id' => 40,
                'salary_rule_id' => 24,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            172 => 
            array (
                'id' => 673,
                'employee_contract_id' => 40,
                'salary_rule_id' => 34,
                'amount' => 3990.0,
                'remark' => '25%',
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            173 => 
            array (
                'id' => 674,
                'employee_contract_id' => 40,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            174 => 
            array (
                'id' => 675,
                'employee_contract_id' => 40,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            175 => 
            array (
                'id' => 676,
                'employee_contract_id' => 40,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            176 => 
            array (
                'id' => 677,
                'employee_contract_id' => 40,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            177 => 
            array (
                'id' => 678,
                'employee_contract_id' => 40,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            178 => 
            array (
                'id' => 679,
                'employee_contract_id' => 40,
                'salary_rule_id' => 12,
                'amount' => 1408.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            179 => 
            array (
                'id' => 680,
                'employee_contract_id' => 40,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            180 => 
            array (
                'id' => 681,
                'employee_contract_id' => 40,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            181 => 
            array (
                'id' => 682,
                'employee_contract_id' => 40,
                'salary_rule_id' => 18,
                'amount' => 1040.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            182 => 
            array (
                'id' => 683,
                'employee_contract_id' => 40,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            183 => 
            array (
                'id' => 684,
                'employee_contract_id' => 40,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            184 => 
            array (
                'id' => 685,
                'employee_contract_id' => 40,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:32:52',
                'updated_at' => '2019-10-27 13:25:09',
            ),
            185 => 
            array (
                'id' => 686,
                'employee_contract_id' => 41,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            186 => 
            array (
                'id' => 687,
                'employee_contract_id' => 41,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            187 => 
            array (
                'id' => 688,
                'employee_contract_id' => 41,
                'salary_rule_id' => 36,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            188 => 
            array (
                'id' => 689,
                'employee_contract_id' => 41,
                'salary_rule_id' => 34,
                'amount' => 850.0,
                'remark' => '10%',
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            189 => 
            array (
                'id' => 690,
                'employee_contract_id' => 41,
                'salary_rule_id' => 5,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            190 => 
            array (
                'id' => 691,
                'employee_contract_id' => 41,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            191 => 
            array (
                'id' => 692,
                'employee_contract_id' => 41,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            192 => 
            array (
                'id' => 693,
                'employee_contract_id' => 41,
                'salary_rule_id' => 10,
                'amount' => 4500.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            193 => 
            array (
                'id' => 694,
                'employee_contract_id' => 41,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            194 => 
            array (
                'id' => 695,
                'employee_contract_id' => 41,
                'salary_rule_id' => 12,
                'amount' => 1612.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            195 => 
            array (
                'id' => 696,
                'employee_contract_id' => 41,
                'salary_rule_id' => 14,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            196 => 
            array (
                'id' => 697,
                'employee_contract_id' => 41,
                'salary_rule_id' => 15,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            197 => 
            array (
                'id' => 698,
                'employee_contract_id' => 41,
                'salary_rule_id' => 18,
                'amount' => 240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            198 => 
            array (
                'id' => 699,
                'employee_contract_id' => 41,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            199 => 
            array (
                'id' => 700,
                'employee_contract_id' => 41,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            200 => 
            array (
                'id' => 701,
                'employee_contract_id' => 41,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:42:41',
                'updated_at' => '2019-10-21 18:42:41',
            ),
            201 => 
            array (
                'id' => 702,
                'employee_contract_id' => 42,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            202 => 
            array (
                'id' => 703,
                'employee_contract_id' => 42,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            203 => 
            array (
                'id' => 704,
                'employee_contract_id' => 42,
                'salary_rule_id' => 36,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            204 => 
            array (
                'id' => 705,
                'employee_contract_id' => 42,
                'salary_rule_id' => 34,
                'amount' => 2100.0,
                'remark' => '20%',
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            205 => 
            array (
                'id' => 706,
                'employee_contract_id' => 42,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            206 => 
            array (
                'id' => 707,
                'employee_contract_id' => 42,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            207 => 
            array (
                'id' => 708,
                'employee_contract_id' => 42,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            208 => 
            array (
                'id' => 709,
                'employee_contract_id' => 42,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            209 => 
            array (
                'id' => 710,
                'employee_contract_id' => 42,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:24',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            210 => 
            array (
                'id' => 711,
                'employee_contract_id' => 42,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:25',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            211 => 
            array (
                'id' => 712,
                'employee_contract_id' => 42,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:25',
                'updated_at' => '2019-10-21 18:45:25',
            ),
            212 => 
            array (
                'id' => 713,
                'employee_contract_id' => 42,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:25',
                'updated_at' => '2019-10-21 18:45:25',
            ),
            213 => 
            array (
                'id' => 714,
                'employee_contract_id' => 42,
                'salary_rule_id' => 18,
                'amount' => 540.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:25',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            214 => 
            array (
                'id' => 715,
                'employee_contract_id' => 42,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:25',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            215 => 
            array (
                'id' => 716,
                'employee_contract_id' => 42,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:25',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            216 => 
            array (
                'id' => 717,
                'employee_contract_id' => 42,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:45:25',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            217 => 
            array (
                'id' => 718,
                'employee_contract_id' => 43,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            218 => 
            array (
                'id' => 719,
                'employee_contract_id' => 43,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            219 => 
            array (
                'id' => 720,
                'employee_contract_id' => 43,
                'salary_rule_id' => 36,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            220 => 
            array (
                'id' => 721,
                'employee_contract_id' => 43,
                'salary_rule_id' => 34,
                'amount' => 1056.0,
                'remark' => '10%',
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            221 => 
            array (
                'id' => 722,
                'employee_contract_id' => 43,
                'salary_rule_id' => 5,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            222 => 
            array (
                'id' => 723,
                'employee_contract_id' => 43,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            223 => 
            array (
                'id' => 724,
                'employee_contract_id' => 43,
                'salary_rule_id' => 8,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            224 => 
            array (
                'id' => 725,
                'employee_contract_id' => 43,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            225 => 
            array (
                'id' => 726,
                'employee_contract_id' => 43,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            226 => 
            array (
                'id' => 727,
                'employee_contract_id' => 43,
                'salary_rule_id' => 12,
                'amount' => 619.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            227 => 
            array (
                'id' => 728,
                'employee_contract_id' => 43,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 13:59:31',
            ),
            228 => 
            array (
                'id' => 729,
                'employee_contract_id' => 43,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 13:59:31',
            ),
            229 => 
            array (
                'id' => 730,
                'employee_contract_id' => 43,
                'salary_rule_id' => 18,
                'amount' => 2149.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            230 => 
            array (
                'id' => 731,
                'employee_contract_id' => 43,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            231 => 
            array (
                'id' => 732,
                'employee_contract_id' => 43,
                'salary_rule_id' => 20,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            232 => 
            array (
                'id' => 733,
                'employee_contract_id' => 43,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-21 18:55:46',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            233 => 
            array (
                'id' => 734,
                'employee_contract_id' => 30,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 12:56:00',
                'updated_at' => '2019-10-22 17:22:16',
            ),
            234 => 
            array (
                'id' => 735,
                'employee_contract_id' => 44,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            235 => 
            array (
                'id' => 736,
                'employee_contract_id' => 44,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            236 => 
            array (
                'id' => 737,
                'employee_contract_id' => 44,
                'salary_rule_id' => 36,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            237 => 
            array (
                'id' => 738,
                'employee_contract_id' => 44,
                'salary_rule_id' => 34,
                'amount' => 2972.0,
                'remark' => '25%',
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            238 => 
            array (
                'id' => 739,
                'employee_contract_id' => 44,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            239 => 
            array (
                'id' => 740,
                'employee_contract_id' => 44,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            240 => 
            array (
                'id' => 741,
                'employee_contract_id' => 44,
                'salary_rule_id' => 8,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            241 => 
            array (
                'id' => 742,
                'employee_contract_id' => 44,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            242 => 
            array (
                'id' => 743,
                'employee_contract_id' => 44,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            243 => 
            array (
                'id' => 744,
                'employee_contract_id' => 44,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            244 => 
            array (
                'id' => 745,
                'employee_contract_id' => 44,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-22 17:21:49',
            ),
            245 => 
            array (
                'id' => 746,
                'employee_contract_id' => 44,
                'salary_rule_id' => 15,
                'amount' => 200.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-22 17:21:49',
            ),
            246 => 
            array (
                'id' => 747,
                'employee_contract_id' => 44,
                'salary_rule_id' => 18,
                'amount' => 540.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            247 => 
            array (
                'id' => 748,
                'employee_contract_id' => 44,
                'salary_rule_id' => 19,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            248 => 
            array (
                'id' => 749,
                'employee_contract_id' => 44,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            249 => 
            array (
                'id' => 750,
                'employee_contract_id' => 44,
                'salary_rule_id' => 21,
                'amount' => 480.0,
                'remark' => 'milk',
                'created_at' => '2019-10-22 13:12:37',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            250 => 
            array (
                'id' => 751,
                'employee_contract_id' => 45,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2020-03-01 13:18:51',
            ),
            251 => 
            array (
                'id' => 752,
                'employee_contract_id' => 45,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            252 => 
            array (
                'id' => 753,
                'employee_contract_id' => 45,
                'salary_rule_id' => 36,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            253 => 
            array (
                'id' => 754,
                'employee_contract_id' => 45,
                'salary_rule_id' => 34,
                'amount' => 1056.0,
                'remark' => '10%',
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            254 => 
            array (
                'id' => 755,
                'employee_contract_id' => 45,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            255 => 
            array (
                'id' => 756,
                'employee_contract_id' => 45,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            256 => 
            array (
                'id' => 757,
                'employee_contract_id' => 45,
                'salary_rule_id' => 8,
                'amount' => 2000.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            257 => 
            array (
                'id' => 758,
                'employee_contract_id' => 45,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            258 => 
            array (
                'id' => 759,
                'employee_contract_id' => 45,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            259 => 
            array (
                'id' => 760,
                'employee_contract_id' => 45,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            260 => 
            array (
                'id' => 761,
                'employee_contract_id' => 45,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 14:06:16',
            ),
            261 => 
            array (
                'id' => 762,
                'employee_contract_id' => 45,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 14:06:16',
            ),
            262 => 
            array (
                'id' => 763,
                'employee_contract_id' => 45,
                'salary_rule_id' => 18,
                'amount' => 1040.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            263 => 
            array (
                'id' => 764,
                'employee_contract_id' => 45,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            264 => 
            array (
                'id' => 765,
                'employee_contract_id' => 45,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            265 => 
            array (
                'id' => 766,
                'employee_contract_id' => 45,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 13:46:30',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            266 => 
            array (
                'id' => 767,
                'employee_contract_id' => 45,
                'salary_rule_id' => 38,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 14:06:16',
                'updated_at' => '2019-10-22 17:21:21',
            ),
            267 => 
            array (
                'id' => 768,
                'employee_contract_id' => 46,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            268 => 
            array (
                'id' => 769,
                'employee_contract_id' => 46,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            269 => 
            array (
                'id' => 770,
                'employee_contract_id' => 46,
                'salary_rule_id' => 24,
                'amount' => 250.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            270 => 
            array (
                'id' => 771,
                'employee_contract_id' => 46,
                'salary_rule_id' => 37,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            271 => 
            array (
                'id' => 772,
                'employee_contract_id' => 46,
                'salary_rule_id' => 34,
                'amount' => 5090.0,
                'remark' => '25%',
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            272 => 
            array (
                'id' => 773,
                'employee_contract_id' => 46,
                'salary_rule_id' => 5,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            273 => 
            array (
                'id' => 774,
                'employee_contract_id' => 46,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            274 => 
            array (
                'id' => 775,
                'employee_contract_id' => 46,
                'salary_rule_id' => 8,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            275 => 
            array (
                'id' => 776,
                'employee_contract_id' => 46,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            276 => 
            array (
                'id' => 777,
                'employee_contract_id' => 46,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            277 => 
            array (
                'id' => 778,
                'employee_contract_id' => 46,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            278 => 
            array (
                'id' => 779,
                'employee_contract_id' => 46,
                'salary_rule_id' => 14,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            279 => 
            array (
                'id' => 780,
                'employee_contract_id' => 46,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            280 => 
            array (
                'id' => 781,
                'employee_contract_id' => 46,
                'salary_rule_id' => 18,
                'amount' => 278.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            281 => 
            array (
                'id' => 782,
                'employee_contract_id' => 46,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            282 => 
            array (
                'id' => 783,
                'employee_contract_id' => 46,
                'salary_rule_id' => 20,
                'amount' => 20.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            283 => 
            array (
                'id' => 784,
                'employee_contract_id' => 46,
                'salary_rule_id' => 21,
                'amount' => 480.0,
                'remark' => 'milk',
                'created_at' => '2019-10-22 15:13:54',
                'updated_at' => '2019-10-22 17:20:44',
            ),
            284 => 
            array (
                'id' => 785,
                'employee_contract_id' => 47,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            285 => 
            array (
                'id' => 786,
                'employee_contract_id' => 47,
                'salary_rule_id' => 34,
                'amount' => 6690.0,
                'remark' => '25%',
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            286 => 
            array (
                'id' => 787,
                'employee_contract_id' => 47,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            287 => 
            array (
                'id' => 788,
                'employee_contract_id' => 47,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            288 => 
            array (
                'id' => 789,
                'employee_contract_id' => 47,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            289 => 
            array (
                'id' => 790,
                'employee_contract_id' => 47,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            290 => 
            array (
                'id' => 791,
                'employee_contract_id' => 47,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            291 => 
            array (
                'id' => 792,
                'employee_contract_id' => 47,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            292 => 
            array (
                'id' => 793,
                'employee_contract_id' => 47,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            293 => 
            array (
                'id' => 794,
                'employee_contract_id' => 47,
                'salary_rule_id' => 14,
                'amount' => 250.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            294 => 
            array (
                'id' => 795,
                'employee_contract_id' => 47,
                'salary_rule_id' => 15,
                'amount' => 236.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            295 => 
            array (
                'id' => 796,
                'employee_contract_id' => 47,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            296 => 
            array (
                'id' => 797,
                'employee_contract_id' => 47,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            297 => 
            array (
                'id' => 798,
                'employee_contract_id' => 47,
                'salary_rule_id' => 18,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            298 => 
            array (
                'id' => 799,
                'employee_contract_id' => 47,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            299 => 
            array (
                'id' => 800,
                'employee_contract_id' => 47,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            300 => 
            array (
                'id' => 801,
                'employee_contract_id' => 47,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 16:56:15',
                'updated_at' => '2019-10-22 16:59:08',
            ),
            301 => 
            array (
                'id' => 802,
                'employee_contract_id' => 48,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            302 => 
            array (
                'id' => 803,
                'employee_contract_id' => 48,
                'salary_rule_id' => 34,
                'amount' => 7025.0,
                'remark' => '25%',
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            303 => 
            array (
                'id' => 804,
                'employee_contract_id' => 48,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            304 => 
            array (
                'id' => 805,
                'employee_contract_id' => 48,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            305 => 
            array (
                'id' => 806,
                'employee_contract_id' => 48,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            306 => 
            array (
                'id' => 807,
                'employee_contract_id' => 48,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            307 => 
            array (
                'id' => 808,
                'employee_contract_id' => 48,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            308 => 
            array (
                'id' => 809,
                'employee_contract_id' => 48,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            309 => 
            array (
                'id' => 810,
                'employee_contract_id' => 48,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            310 => 
            array (
                'id' => 811,
                'employee_contract_id' => 48,
                'salary_rule_id' => 14,
                'amount' => 250.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            311 => 
            array (
                'id' => 812,
                'employee_contract_id' => 48,
                'salary_rule_id' => 15,
                'amount' => 46.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            312 => 
            array (
                'id' => 813,
                'employee_contract_id' => 48,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            313 => 
            array (
                'id' => 814,
                'employee_contract_id' => 48,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            314 => 
            array (
                'id' => 815,
                'employee_contract_id' => 48,
                'salary_rule_id' => 18,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            315 => 
            array (
                'id' => 816,
                'employee_contract_id' => 48,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            316 => 
            array (
                'id' => 817,
                'employee_contract_id' => 48,
                'salary_rule_id' => 20,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            317 => 
            array (
                'id' => 818,
                'employee_contract_id' => 48,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:04:19',
                'updated_at' => '2019-10-22 17:04:19',
            ),
            318 => 
            array (
                'id' => 819,
                'employee_contract_id' => 49,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            319 => 
            array (
                'id' => 820,
                'employee_contract_id' => 49,
                'salary_rule_id' => 34,
                'amount' => 5352.0,
                'remark' => '20%',
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            320 => 
            array (
                'id' => 821,
                'employee_contract_id' => 49,
                'salary_rule_id' => 5,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            321 => 
            array (
                'id' => 822,
                'employee_contract_id' => 49,
                'salary_rule_id' => 6,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            322 => 
            array (
                'id' => 823,
                'employee_contract_id' => 49,
                'salary_rule_id' => 7,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            323 => 
            array (
                'id' => 824,
                'employee_contract_id' => 49,
                'salary_rule_id' => 8,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            324 => 
            array (
                'id' => 825,
                'employee_contract_id' => 49,
                'salary_rule_id' => 10,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            325 => 
            array (
                'id' => 826,
                'employee_contract_id' => 49,
                'salary_rule_id' => 11,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            326 => 
            array (
                'id' => 827,
                'employee_contract_id' => 49,
                'salary_rule_id' => 12,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            327 => 
            array (
                'id' => 828,
                'employee_contract_id' => 49,
                'salary_rule_id' => 14,
                'amount' => 250.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            328 => 
            array (
                'id' => 829,
                'employee_contract_id' => 49,
                'salary_rule_id' => 15,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            329 => 
            array (
                'id' => 830,
                'employee_contract_id' => 49,
                'salary_rule_id' => 16,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            330 => 
            array (
                'id' => 831,
                'employee_contract_id' => 49,
                'salary_rule_id' => 17,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            331 => 
            array (
                'id' => 832,
                'employee_contract_id' => 49,
                'salary_rule_id' => 18,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            332 => 
            array (
                'id' => 833,
                'employee_contract_id' => 49,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            333 => 
            array (
                'id' => 834,
                'employee_contract_id' => 49,
                'salary_rule_id' => 20,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            334 => 
            array (
                'id' => 835,
                'employee_contract_id' => 49,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:08:02',
                'updated_at' => '2019-10-22 17:08:02',
            ),
            335 => 
            array (
                'id' => 836,
                'employee_contract_id' => 50,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            336 => 
            array (
                'id' => 837,
                'employee_contract_id' => 50,
                'salary_rule_id' => 34,
                'amount' => 3836.0,
                'remark' => '13%',
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:24',
            ),
            337 => 
            array (
                'id' => 838,
                'employee_contract_id' => 50,
                'salary_rule_id' => 5,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:24',
            ),
            338 => 
            array (
                'id' => 839,
                'employee_contract_id' => 50,
                'salary_rule_id' => 6,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:24',
            ),
            339 => 
            array (
                'id' => 840,
                'employee_contract_id' => 50,
                'salary_rule_id' => 7,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:24',
            ),
            340 => 
            array (
                'id' => 841,
                'employee_contract_id' => 50,
                'salary_rule_id' => 8,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            341 => 
            array (
                'id' => 842,
                'employee_contract_id' => 50,
                'salary_rule_id' => 10,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            342 => 
            array (
                'id' => 843,
                'employee_contract_id' => 50,
                'salary_rule_id' => 11,
                'amount' => 975.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            343 => 
            array (
                'id' => 844,
                'employee_contract_id' => 50,
                'salary_rule_id' => 12,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            344 => 
            array (
                'id' => 845,
                'employee_contract_id' => 50,
                'salary_rule_id' => 14,
                'amount' => 250.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            345 => 
            array (
                'id' => 846,
                'employee_contract_id' => 50,
                'salary_rule_id' => 15,
                'amount' => 68.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            346 => 
            array (
                'id' => 847,
                'employee_contract_id' => 50,
                'salary_rule_id' => 16,
                'amount' => 100.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            347 => 
            array (
                'id' => 848,
                'employee_contract_id' => 50,
                'salary_rule_id' => 17,
                'amount' => 50.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            348 => 
            array (
                'id' => 849,
                'employee_contract_id' => 50,
                'salary_rule_id' => 18,
                'amount' => 2000.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            349 => 
            array (
                'id' => 850,
                'employee_contract_id' => 50,
                'salary_rule_id' => 19,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            350 => 
            array (
                'id' => 851,
                'employee_contract_id' => 50,
                'salary_rule_id' => 20,
                'amount' => 1000.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            351 => 
            array (
                'id' => 852,
                'employee_contract_id' => 50,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2019-10-22 17:19:21',
                'updated_at' => '2019-10-23 11:40:25',
            ),
            352 => 
            array (
                'id' => 853,
                'employee_contract_id' => 5,
                'salary_rule_id' => 24,
                'amount' => 1500.0,
                'remark' => NULL,
                'created_at' => '2019-10-23 10:38:50',
                'updated_at' => '2019-10-23 12:36:13',
            ),
            353 => 
            array (
                'id' => 854,
                'employee_contract_id' => 6,
                'salary_rule_id' => 24,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-23 10:39:10',
                'updated_at' => '2019-10-23 10:39:10',
            ),
            354 => 
            array (
                'id' => 855,
                'employee_contract_id' => 42,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-27 13:37:55',
                'updated_at' => '2019-10-27 13:39:28',
            ),
            355 => 
            array (
                'id' => 856,
                'employee_contract_id' => 43,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-27 14:03:25',
                'updated_at' => '2019-10-27 14:04:05',
            ),
            356 => 
            array (
                'id' => 857,
                'employee_contract_id' => 44,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2019-10-27 14:07:05',
                'updated_at' => '2019-10-27 14:07:05',
            ),
            357 => 
            array (
                'id' => 858,
                'employee_contract_id' => 51,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            358 => 
            array (
                'id' => 859,
                'employee_contract_id' => 52,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            359 => 
            array (
                'id' => 860,
                'employee_contract_id' => 53,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            360 => 
            array (
                'id' => 861,
                'employee_contract_id' => 54,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            361 => 
            array (
                'id' => 862,
                'employee_contract_id' => 55,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            362 => 
            array (
                'id' => 863,
                'employee_contract_id' => 56,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            363 => 
            array (
                'id' => 864,
                'employee_contract_id' => 57,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:52',
            ),
            364 => 
            array (
                'id' => 865,
                'employee_contract_id' => 58,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            365 => 
            array (
                'id' => 866,
                'employee_contract_id' => 59,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            366 => 
            array (
                'id' => 867,
                'employee_contract_id' => 60,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            367 => 
            array (
                'id' => 868,
                'employee_contract_id' => 61,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            368 => 
            array (
                'id' => 869,
                'employee_contract_id' => 62,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            369 => 
            array (
                'id' => 870,
                'employee_contract_id' => 63,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            370 => 
            array (
                'id' => 871,
                'employee_contract_id' => 64,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            371 => 
            array (
                'id' => 872,
                'employee_contract_id' => 65,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            372 => 
            array (
                'id' => 873,
                'employee_contract_id' => 66,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            373 => 
            array (
                'id' => 874,
                'employee_contract_id' => 67,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            374 => 
            array (
                'id' => 875,
                'employee_contract_id' => 68,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:53',
            ),
            375 => 
            array (
                'id' => 876,
                'employee_contract_id' => 69,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            376 => 
            array (
                'id' => 877,
                'employee_contract_id' => 70,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            377 => 
            array (
                'id' => 878,
                'employee_contract_id' => 71,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            378 => 
            array (
                'id' => 879,
                'employee_contract_id' => 72,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            379 => 
            array (
                'id' => 880,
                'employee_contract_id' => 73,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:04',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            380 => 
            array (
                'id' => 881,
                'employee_contract_id' => 74,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            381 => 
            array (
                'id' => 882,
                'employee_contract_id' => 75,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            382 => 
            array (
                'id' => 883,
                'employee_contract_id' => 76,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            383 => 
            array (
                'id' => 884,
                'employee_contract_id' => 77,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            384 => 
            array (
                'id' => 885,
                'employee_contract_id' => 78,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            385 => 
            array (
                'id' => 886,
                'employee_contract_id' => 79,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:54',
            ),
            386 => 
            array (
                'id' => 887,
                'employee_contract_id' => 80,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            387 => 
            array (
                'id' => 888,
                'employee_contract_id' => 81,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            388 => 
            array (
                'id' => 889,
                'employee_contract_id' => 82,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            389 => 
            array (
                'id' => 890,
                'employee_contract_id' => 83,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            390 => 
            array (
                'id' => 891,
                'employee_contract_id' => 84,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            391 => 
            array (
                'id' => 892,
                'employee_contract_id' => 85,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            392 => 
            array (
                'id' => 893,
                'employee_contract_id' => 86,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            393 => 
            array (
                'id' => 894,
                'employee_contract_id' => 87,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            394 => 
            array (
                'id' => 895,
                'employee_contract_id' => 88,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            395 => 
            array (
                'id' => 896,
                'employee_contract_id' => 89,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            396 => 
            array (
                'id' => 897,
                'employee_contract_id' => 90,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            397 => 
            array (
                'id' => 898,
                'employee_contract_id' => 91,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:55',
            ),
            398 => 
            array (
                'id' => 899,
                'employee_contract_id' => 92,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            399 => 
            array (
                'id' => 900,
                'employee_contract_id' => 93,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            400 => 
            array (
                'id' => 901,
                'employee_contract_id' => 94,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:05',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            401 => 
            array (
                'id' => 902,
                'employee_contract_id' => 95,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            402 => 
            array (
                'id' => 903,
                'employee_contract_id' => 96,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            403 => 
            array (
                'id' => 904,
                'employee_contract_id' => 97,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            404 => 
            array (
                'id' => 905,
                'employee_contract_id' => 98,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            405 => 
            array (
                'id' => 906,
                'employee_contract_id' => 99,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            406 => 
            array (
                'id' => 907,
                'employee_contract_id' => 100,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            407 => 
            array (
                'id' => 908,
                'employee_contract_id' => 101,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            408 => 
            array (
                'id' => 909,
                'employee_contract_id' => 102,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:56',
            ),
            409 => 
            array (
                'id' => 910,
                'employee_contract_id' => 103,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-02-13 13:54:06',
            ),
            410 => 
            array (
                'id' => 911,
                'employee_contract_id' => 104,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            411 => 
            array (
                'id' => 912,
                'employee_contract_id' => 105,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            412 => 
            array (
                'id' => 913,
                'employee_contract_id' => 106,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            413 => 
            array (
                'id' => 914,
                'employee_contract_id' => 107,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            414 => 
            array (
                'id' => 915,
                'employee_contract_id' => 108,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            415 => 
            array (
                'id' => 916,
                'employee_contract_id' => 109,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            416 => 
            array (
                'id' => 917,
                'employee_contract_id' => 110,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            417 => 
            array (
                'id' => 918,
                'employee_contract_id' => 111,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            418 => 
            array (
                'id' => 919,
                'employee_contract_id' => 112,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            419 => 
            array (
                'id' => 920,
                'employee_contract_id' => 120,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            420 => 
            array (
                'id' => 921,
                'employee_contract_id' => 121,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            421 => 
            array (
                'id' => 922,
                'employee_contract_id' => 122,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            422 => 
            array (
                'id' => 923,
                'employee_contract_id' => 123,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            423 => 
            array (
                'id' => 924,
                'employee_contract_id' => 124,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:06',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            424 => 
            array (
                'id' => 925,
                'employee_contract_id' => 125,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            425 => 
            array (
                'id' => 926,
                'employee_contract_id' => 126,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            426 => 
            array (
                'id' => 927,
                'employee_contract_id' => 127,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            427 => 
            array (
                'id' => 928,
                'employee_contract_id' => 128,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            428 => 
            array (
                'id' => 929,
                'employee_contract_id' => 129,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            429 => 
            array (
                'id' => 930,
                'employee_contract_id' => 130,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            430 => 
            array (
                'id' => 931,
                'employee_contract_id' => 131,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            431 => 
            array (
                'id' => 932,
                'employee_contract_id' => 132,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            432 => 
            array (
                'id' => 933,
                'employee_contract_id' => 133,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            433 => 
            array (
                'id' => 934,
                'employee_contract_id' => 134,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            434 => 
            array (
                'id' => 935,
                'employee_contract_id' => 135,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            435 => 
            array (
                'id' => 936,
                'employee_contract_id' => 136,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            436 => 
            array (
                'id' => 937,
                'employee_contract_id' => 137,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            437 => 
            array (
                'id' => 938,
                'employee_contract_id' => 138,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:18:59',
            ),
            438 => 
            array (
                'id' => 939,
                'employee_contract_id' => 139,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            439 => 
            array (
                'id' => 940,
                'employee_contract_id' => 140,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            440 => 
            array (
                'id' => 941,
                'employee_contract_id' => 141,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            441 => 
            array (
                'id' => 942,
                'employee_contract_id' => 142,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            442 => 
            array (
                'id' => 943,
                'employee_contract_id' => 143,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            443 => 
            array (
                'id' => 944,
                'employee_contract_id' => 144,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            444 => 
            array (
                'id' => 945,
                'employee_contract_id' => 145,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            445 => 
            array (
                'id' => 946,
                'employee_contract_id' => 146,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            446 => 
            array (
                'id' => 947,
                'employee_contract_id' => 147,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            447 => 
            array (
                'id' => 948,
                'employee_contract_id' => 148,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:07',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            448 => 
            array (
                'id' => 949,
                'employee_contract_id' => 149,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            449 => 
            array (
                'id' => 950,
                'employee_contract_id' => 150,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:00',
            ),
            450 => 
            array (
                'id' => 951,
                'employee_contract_id' => 151,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            451 => 
            array (
                'id' => 952,
                'employee_contract_id' => 152,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            452 => 
            array (
                'id' => 953,
                'employee_contract_id' => 153,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            453 => 
            array (
                'id' => 954,
                'employee_contract_id' => 154,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            454 => 
            array (
                'id' => 955,
                'employee_contract_id' => 155,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            455 => 
            array (
                'id' => 956,
                'employee_contract_id' => 156,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            456 => 
            array (
                'id' => 957,
                'employee_contract_id' => 157,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            457 => 
            array (
                'id' => 958,
                'employee_contract_id' => 158,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            458 => 
            array (
                'id' => 959,
                'employee_contract_id' => 159,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            459 => 
            array (
                'id' => 960,
                'employee_contract_id' => 160,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            460 => 
            array (
                'id' => 961,
                'employee_contract_id' => 161,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            461 => 
            array (
                'id' => 962,
                'employee_contract_id' => 162,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:01',
            ),
            462 => 
            array (
                'id' => 963,
                'employee_contract_id' => 163,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            463 => 
            array (
                'id' => 964,
                'employee_contract_id' => 164,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            464 => 
            array (
                'id' => 965,
                'employee_contract_id' => 165,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            465 => 
            array (
                'id' => 966,
                'employee_contract_id' => 166,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            466 => 
            array (
                'id' => 967,
                'employee_contract_id' => 167,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:18:07',
            ),
            467 => 
            array (
                'id' => 968,
                'employee_contract_id' => 168,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            468 => 
            array (
                'id' => 969,
                'employee_contract_id' => 169,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            469 => 
            array (
                'id' => 970,
                'employee_contract_id' => 170,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            470 => 
            array (
                'id' => 971,
                'employee_contract_id' => 171,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            471 => 
            array (
                'id' => 972,
                'employee_contract_id' => 172,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            472 => 
            array (
                'id' => 973,
                'employee_contract_id' => 173,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:08',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            473 => 
            array (
                'id' => 974,
                'employee_contract_id' => 174,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            474 => 
            array (
                'id' => 975,
                'employee_contract_id' => 175,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:02',
            ),
            475 => 
            array (
                'id' => 976,
                'employee_contract_id' => 176,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            476 => 
            array (
                'id' => 977,
                'employee_contract_id' => 177,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            477 => 
            array (
                'id' => 978,
                'employee_contract_id' => 178,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            478 => 
            array (
                'id' => 979,
                'employee_contract_id' => 179,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            479 => 
            array (
                'id' => 980,
                'employee_contract_id' => 180,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            480 => 
            array (
                'id' => 981,
                'employee_contract_id' => 181,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            481 => 
            array (
                'id' => 982,
                'employee_contract_id' => 182,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            482 => 
            array (
                'id' => 983,
                'employee_contract_id' => 183,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            483 => 
            array (
                'id' => 984,
                'employee_contract_id' => 184,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            484 => 
            array (
                'id' => 985,
                'employee_contract_id' => 185,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            485 => 
            array (
                'id' => 986,
                'employee_contract_id' => 186,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:09',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            486 => 
            array (
                'id' => 987,
                'employee_contract_id' => 187,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:03',
            ),
            487 => 
            array (
                'id' => 988,
                'employee_contract_id' => 188,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            488 => 
            array (
                'id' => 989,
                'employee_contract_id' => 189,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            489 => 
            array (
                'id' => 990,
                'employee_contract_id' => 190,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            490 => 
            array (
                'id' => 991,
                'employee_contract_id' => 191,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            491 => 
            array (
                'id' => 992,
                'employee_contract_id' => 192,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            492 => 
            array (
                'id' => 993,
                'employee_contract_id' => 193,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            493 => 
            array (
                'id' => 994,
                'employee_contract_id' => 194,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            494 => 
            array (
                'id' => 995,
                'employee_contract_id' => 195,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            495 => 
            array (
                'id' => 996,
                'employee_contract_id' => 196,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            496 => 
            array (
                'id' => 997,
                'employee_contract_id' => 197,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            497 => 
            array (
                'id' => 998,
                'employee_contract_id' => 198,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:04',
            ),
            498 => 
            array (
                'id' => 999,
                'employee_contract_id' => 199,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            499 => 
            array (
                'id' => 1000,
                'employee_contract_id' => 200,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:05',
            ),
        ));
        \DB::table('employee_contract_assigned_rules')->insert(array (
            0 => 
            array (
                'id' => 1001,
                'employee_contract_id' => 201,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            1 => 
            array (
                'id' => 1002,
                'employee_contract_id' => 202,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            2 => 
            array (
                'id' => 1003,
                'employee_contract_id' => 203,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            3 => 
            array (
                'id' => 1004,
                'employee_contract_id' => 204,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:20',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            4 => 
            array (
                'id' => 1005,
                'employee_contract_id' => 205,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            5 => 
            array (
                'id' => 1006,
                'employee_contract_id' => 206,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            6 => 
            array (
                'id' => 1007,
                'employee_contract_id' => 207,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            7 => 
            array (
                'id' => 1008,
                'employee_contract_id' => 208,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            8 => 
            array (
                'id' => 1009,
                'employee_contract_id' => 209,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            9 => 
            array (
                'id' => 1010,
                'employee_contract_id' => 210,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            10 => 
            array (
                'id' => 1011,
                'employee_contract_id' => 211,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:05',
            ),
            11 => 
            array (
                'id' => 1012,
                'employee_contract_id' => 212,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            12 => 
            array (
                'id' => 1013,
                'employee_contract_id' => 213,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            13 => 
            array (
                'id' => 1014,
                'employee_contract_id' => 214,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            14 => 
            array (
                'id' => 1015,
                'employee_contract_id' => 215,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            15 => 
            array (
                'id' => 1016,
                'employee_contract_id' => 216,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            16 => 
            array (
                'id' => 1017,
                'employee_contract_id' => 217,
                'salary_rule_id' => 34,
                'amount' => 10800.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            17 => 
            array (
                'id' => 1018,
                'employee_contract_id' => 218,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            18 => 
            array (
                'id' => 1019,
                'employee_contract_id' => 219,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            19 => 
            array (
                'id' => 1020,
                'employee_contract_id' => 220,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            20 => 
            array (
                'id' => 1021,
                'employee_contract_id' => 221,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            21 => 
            array (
                'id' => 1022,
                'employee_contract_id' => 222,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            22 => 
            array (
                'id' => 1023,
                'employee_contract_id' => 223,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            23 => 
            array (
                'id' => 1024,
                'employee_contract_id' => 224,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:06',
            ),
            24 => 
            array (
                'id' => 1025,
                'employee_contract_id' => 225,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            25 => 
            array (
                'id' => 1026,
                'employee_contract_id' => 226,
                'salary_rule_id' => 21,
                'amount' => 0.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            26 => 
            array (
                'id' => 1027,
                'employee_contract_id' => 227,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            27 => 
            array (
                'id' => 1028,
                'employee_contract_id' => 228,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            28 => 
            array (
                'id' => 1029,
                'employee_contract_id' => 229,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            29 => 
            array (
                'id' => 1030,
                'employee_contract_id' => 230,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:21',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            30 => 
            array (
                'id' => 1031,
                'employee_contract_id' => 231,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            31 => 
            array (
                'id' => 1032,
                'employee_contract_id' => 232,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            32 => 
            array (
                'id' => 1033,
                'employee_contract_id' => 233,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            33 => 
            array (
                'id' => 1034,
                'employee_contract_id' => 234,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            34 => 
            array (
                'id' => 1035,
                'employee_contract_id' => 235,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            35 => 
            array (
                'id' => 1036,
                'employee_contract_id' => 236,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:07',
            ),
            36 => 
            array (
                'id' => 1037,
                'employee_contract_id' => 237,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            37 => 
            array (
                'id' => 1038,
                'employee_contract_id' => 242,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            38 => 
            array (
                'id' => 1039,
                'employee_contract_id' => 243,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            39 => 
            array (
                'id' => 1040,
                'employee_contract_id' => 244,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            40 => 
            array (
                'id' => 1041,
                'employee_contract_id' => 245,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            41 => 
            array (
                'id' => 1042,
                'employee_contract_id' => 246,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            42 => 
            array (
                'id' => 1043,
                'employee_contract_id' => 247,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            43 => 
            array (
                'id' => 1044,
                'employee_contract_id' => 248,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:07',
            ),
            44 => 
            array (
                'id' => 1045,
                'employee_contract_id' => 249,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:09',
            ),
            45 => 
            array (
                'id' => 1046,
                'employee_contract_id' => 250,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:00',
            ),
            46 => 
            array (
                'id' => 1047,
                'employee_contract_id' => 251,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:17:56',
            ),
            47 => 
            array (
                'id' => 1048,
                'employee_contract_id' => 252,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:17:55',
            ),
            48 => 
            array (
                'id' => 1049,
                'employee_contract_id' => 253,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:13',
            ),
            49 => 
            array (
                'id' => 1050,
                'employee_contract_id' => 254,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:03',
            ),
            50 => 
            array (
                'id' => 1051,
                'employee_contract_id' => 255,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            51 => 
            array (
                'id' => 1052,
                'employee_contract_id' => 256,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:09',
            ),
            52 => 
            array (
                'id' => 1053,
                'employee_contract_id' => 257,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:08',
            ),
            53 => 
            array (
                'id' => 1054,
                'employee_contract_id' => 258,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:07',
            ),
            54 => 
            array (
                'id' => 1055,
                'employee_contract_id' => 259,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:08',
            ),
            55 => 
            array (
                'id' => 1056,
                'employee_contract_id' => 260,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:05',
            ),
            56 => 
            array (
                'id' => 1057,
                'employee_contract_id' => 261,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:04',
            ),
            57 => 
            array (
                'id' => 1058,
                'employee_contract_id' => 262,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:04',
            ),
            58 => 
            array (
                'id' => 1059,
                'employee_contract_id' => 263,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            59 => 
            array (
                'id' => 1060,
                'employee_contract_id' => 264,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:01',
            ),
            60 => 
            array (
                'id' => 1061,
                'employee_contract_id' => 265,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            61 => 
            array (
                'id' => 1062,
                'employee_contract_id' => 266,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:17:57',
            ),
            62 => 
            array (
                'id' => 1063,
                'employee_contract_id' => 267,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:01',
            ),
            63 => 
            array (
                'id' => 1064,
                'employee_contract_id' => 268,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:11',
            ),
            64 => 
            array (
                'id' => 1065,
                'employee_contract_id' => 269,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:06',
            ),
            65 => 
            array (
                'id' => 1066,
                'employee_contract_id' => 270,
                'salary_rule_id' => 21,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:08',
            ),
            66 => 
            array (
                'id' => 1067,
                'employee_contract_id' => 271,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            67 => 
            array (
                'id' => 1068,
                'employee_contract_id' => 272,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            68 => 
            array (
                'id' => 1069,
                'employee_contract_id' => 273,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            69 => 
            array (
                'id' => 1070,
                'employee_contract_id' => 274,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:02',
            ),
            70 => 
            array (
                'id' => 1071,
                'employee_contract_id' => 275,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            71 => 
            array (
                'id' => 1072,
                'employee_contract_id' => 276,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            72 => 
            array (
                'id' => 1073,
                'employee_contract_id' => 277,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            73 => 
            array (
                'id' => 1074,
                'employee_contract_id' => 278,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:13',
            ),
            74 => 
            array (
                'id' => 1075,
                'employee_contract_id' => 279,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:07',
            ),
            75 => 
            array (
                'id' => 1076,
                'employee_contract_id' => 280,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:01',
            ),
            76 => 
            array (
                'id' => 1077,
                'employee_contract_id' => 281,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 13:54:22',
            ),
            77 => 
            array (
                'id' => 1078,
                'employee_contract_id' => 282,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 13:54:22',
            ),
            78 => 
            array (
                'id' => 1079,
                'employee_contract_id' => 283,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 13:54:22',
            ),
            79 => 
            array (
                'id' => 1080,
                'employee_contract_id' => 284,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            80 => 
            array (
                'id' => 1081,
                'employee_contract_id' => 285,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 13:54:22',
            ),
            81 => 
            array (
                'id' => 1082,
                'employee_contract_id' => 286,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 13:54:22',
            ),
            82 => 
            array (
                'id' => 1083,
                'employee_contract_id' => 287,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 13:54:22',
            ),
            83 => 
            array (
                'id' => 1084,
                'employee_contract_id' => 288,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            84 => 
            array (
                'id' => 1085,
                'employee_contract_id' => 289,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            85 => 
            array (
                'id' => 1086,
                'employee_contract_id' => 290,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            86 => 
            array (
                'id' => 1087,
                'employee_contract_id' => 291,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            87 => 
            array (
                'id' => 1088,
                'employee_contract_id' => 292,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            88 => 
            array (
                'id' => 1089,
                'employee_contract_id' => 293,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            89 => 
            array (
                'id' => 1090,
                'employee_contract_id' => 294,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            90 => 
            array (
                'id' => 1091,
                'employee_contract_id' => 295,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-03-01 13:18:11',
            ),
            91 => 
            array (
                'id' => 1092,
                'employee_contract_id' => 296,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:22',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            92 => 
            array (
                'id' => 1093,
                'employee_contract_id' => 297,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            93 => 
            array (
                'id' => 1094,
                'employee_contract_id' => 298,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            94 => 
            array (
                'id' => 1095,
                'employee_contract_id' => 299,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            95 => 
            array (
                'id' => 1096,
                'employee_contract_id' => 300,
                'salary_rule_id' => 24,
                'amount' => 1250.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            96 => 
            array (
                'id' => 1097,
                'employee_contract_id' => 301,
                'salary_rule_id' => 24,
                'amount' => 1250.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            97 => 
            array (
                'id' => 1098,
                'employee_contract_id' => 302,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            98 => 
            array (
                'id' => 1099,
                'employee_contract_id' => 303,
                'salary_rule_id' => 24,
                'amount' => 1250.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            99 => 
            array (
                'id' => 1100,
                'employee_contract_id' => 304,
                'salary_rule_id' => 24,
                'amount' => 1250.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            100 => 
            array (
                'id' => 1101,
                'employee_contract_id' => 305,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:18:04',
            ),
            101 => 
            array (
                'id' => 1102,
                'employee_contract_id' => 306,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:17:55',
            ),
            102 => 
            array (
                'id' => 1103,
                'employee_contract_id' => 307,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:17:55',
            ),
            103 => 
            array (
                'id' => 1104,
                'employee_contract_id' => 308,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:14',
            ),
            104 => 
            array (
                'id' => 1105,
                'employee_contract_id' => 309,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:18:01',
            ),
            105 => 
            array (
                'id' => 1106,
                'employee_contract_id' => 310,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:18:03',
            ),
            106 => 
            array (
                'id' => 1107,
                'employee_contract_id' => 311,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:18:04',
            ),
            107 => 
            array (
                'id' => 1108,
                'employee_contract_id' => 312,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:18:02',
            ),
            108 => 
            array (
                'id' => 1109,
                'employee_contract_id' => 313,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-03-01 13:18:01',
            ),
            109 => 
            array (
                'id' => 1110,
                'employee_contract_id' => 314,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:15',
            ),
            110 => 
            array (
                'id' => 1111,
                'employee_contract_id' => 315,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:15',
            ),
            111 => 
            array (
                'id' => 1112,
                'employee_contract_id' => 316,
                'salary_rule_id' => 23,
                'amount' => 300.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 14:42:15',
            ),
            112 => 
            array (
                'id' => 1113,
                'employee_contract_id' => 317,
                'salary_rule_id' => 38,
                'amount' => NULL,
                'remark' => NULL,
                'created_at' => '2020-02-13 13:54:23',
                'updated_at' => '2020-02-13 13:54:23',
            ),
            113 => 
            array (
                'id' => 1114,
                'employee_contract_id' => 238,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 14:42:13',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            114 => 
            array (
                'id' => 1115,
                'employee_contract_id' => 239,
                'salary_rule_id' => 34,
                'amount' => 12792.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 14:42:13',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            115 => 
            array (
                'id' => 1116,
                'employee_contract_id' => 240,
                'salary_rule_id' => 34,
                'amount' => 19122.0,
                'remark' => '25%',
                'created_at' => '2020-02-13 14:42:13',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            116 => 
            array (
                'id' => 1117,
                'employee_contract_id' => 241,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 14:42:13',
                'updated_at' => '2020-03-01 13:19:08',
            ),
            117 => 
            array (
                'id' => 1118,
                'employee_contract_id' => 318,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-02-13 14:42:15',
                'updated_at' => '2020-02-13 14:42:15',
            ),
            118 => 
            array (
                'id' => 1119,
                'employee_contract_id' => 115,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:00',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            119 => 
            array (
                'id' => 1120,
                'employee_contract_id' => 118,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:00',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            120 => 
            array (
                'id' => 1121,
                'employee_contract_id' => 114,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:00',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            121 => 
            array (
                'id' => 1122,
                'employee_contract_id' => 319,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:03',
                'updated_at' => '2020-03-01 13:18:03',
            ),
            122 => 
            array (
                'id' => 1123,
                'employee_contract_id' => 116,
                'salary_rule_id' => 34,
                'amount' => 12240.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:05',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            123 => 
            array (
                'id' => 1124,
                'employee_contract_id' => 113,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:08',
                'updated_at' => '2020-03-01 13:18:57',
            ),
            124 => 
            array (
                'id' => 1125,
                'employee_contract_id' => 119,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:11',
                'updated_at' => '2020-03-01 13:18:58',
            ),
            125 => 
            array (
                'id' => 1126,
                'employee_contract_id' => 117,
                'salary_rule_id' => 34,
                'amount' => 14640.0,
                'remark' => NULL,
                'created_at' => '2020-03-01 13:18:58',
                'updated_at' => '2020-03-01 13:18:58',
            ),
        ));
        
        
    }
}
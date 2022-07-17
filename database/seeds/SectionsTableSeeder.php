<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sections')->delete();
        
        \DB::table('sections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Establishment',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => 9,
                'deleted_at' => NULL,
                'created_at' => '2019-11-11 15:31:33',
                'updated_at' => '2019-11-11 15:31:33',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Despatch',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-11 15:31:56',
                'updated_at' => '2019-11-11 15:31:56',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Accounts',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-11 15:32:53',
                'updated_at' => '2019-11-11 15:32:53',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Audit and Pension',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-11 16:37:49',
                'updated_at' => '2019-11-11 16:37:49',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Maintenance',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:48:22',
                'updated_at' => '2019-11-12 15:48:22',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Electric',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:48:42',
                'updated_at' => '2019-11-12 15:48:42',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Telephone',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:48:57',
                'updated_at' => '2019-11-12 15:48:57',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Development Communication',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:49:45',
                'updated_at' => '2019-11-12 15:49:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Communication',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:50:05',
                'updated_at' => '2019-11-12 15:50:05',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Photography',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:50:20',
                'updated_at' => '2019-11-12 15:50:20',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Art Works',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:52:19',
                'updated_at' => '2019-11-12 15:52:19',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Library',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:52:37',
                'updated_at' => '2019-11-12 15:52:37',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Hostel',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => '2019-11-12 15:53:58',
                'created_at' => '2019-11-12 15:52:55',
                'updated_at' => '2019-11-12 15:53:58',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Documentation',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:54:22',
                'updated_at' => '2019-11-12 15:54:22',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Hostel',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:54:55',
                'updated_at' => '2019-11-12 15:54:55',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Cafeteria',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:56:13',
                'updated_at' => '2019-11-12 15:56:13',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Caretaking',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:56:35',
                'updated_at' => '2019-11-12 15:56:35',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Store',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:57:03',
                'updated_at' => '2019-11-12 15:57:03',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Medical Centre',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:57:56',
                'updated_at' => '2019-11-12 15:57:56',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'BARD Model School',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:58:22',
                'updated_at' => '2019-11-12 15:58:22',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Mosque',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 15:59:50',
                'updated_at' => '2019-11-12 15:59:50',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Dhaka Liaison Office',
                'section_code' => NULL,
                'department_id' => 9,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 16:00:11',
                'updated_at' => '2019-11-12 16:00:11',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Publication',
                'section_code' => NULL,
                'department_id' => 1,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 16:00:35',
                'updated_at' => '2019-11-12 16:00:35',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Sports and Recreation Centre',
                'section_code' => NULL,
                'department_id' => 7,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 16:00:53',
                'updated_at' => '2019-11-12 16:00:53',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Garden',
                'section_code' => NULL,
                'department_id' => 10,
                'section_head_employee_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-11-12 16:01:09',
                'updated_at' => '2019-11-12 16:01:09',
            ),
        ));
        
        
    }
}
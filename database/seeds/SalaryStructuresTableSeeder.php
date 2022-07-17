<?php

use Illuminate\Database\Seeder;

class SalaryStructuresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_structures')->delete();
        
        \DB::table('salary_structures')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_structure' => NULL,
                'name' => 'Base for new Structure',
                'reference' => 'Base',
                'is_parent' => 1,
                'deleted_at' => NULL,
                'created_at' => '2019-10-06 12:52:34',
                'updated_at' => '2019-10-06 13:01:53',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_structure' => 1,
                'name' => 'Director General',
                'reference' => 'DG',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-10-07 16:37:30',
                'updated_at' => '2019-10-07 16:37:30',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_structure' => 1,
                'name' => 'Director, Joint Director and Deputy Director',
                'reference' => 'D,JD&DD',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-10-15 12:40:41',
                'updated_at' => '2019-10-20 11:13:45',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_structure' => 5,
                'name' => 'sonsthapon-1',
                'reference' => 'sonsthapon-1',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-10-21 13:04:53',
                'updated_at' => '2019-10-21 17:29:59',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_structure' => NULL,
                'name' => 'Base Structure For Grade 11-20',
                'reference' => 'Base Structure for songsthapon-1',
                'is_parent' => 1,
                'deleted_at' => NULL,
                'created_at' => '2019-10-21 13:28:16',
                'updated_at' => '2019-10-21 16:16:39',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_structure' => 1,
            'name' => 'Grade 11 (Official)',
                'reference' => 'Salary  Structure for Grade 11',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-10-21 13:37:49',
                'updated_at' => '2019-10-21 14:50:06',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_structure' => 5,
            'name' => 'Grade 12 (Official)',
                'reference' => 'Salary  Structure for Grade 12',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-10-21 15:27:19',
                'updated_at' => '2019-10-21 16:19:44',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_structure' => 5,
                'name' => 'Sonsthapon -2',
                'reference' => 'sonsthapon-2',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-10-21 17:32:13',
                'updated_at' => '2019-10-21 17:32:13',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_structure' => 10,
                'name' => 'Grade 17-20',
                'reference' => 'Salary Structure for Grade 17-20',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-10-22 13:40:16',
                'updated_at' => '2019-10-22 14:13:04',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_structure' => NULL,
                'name' => 'Base Structure for structure 17-20',
                'reference' => 'Base Structure for structure 17-20',
                'is_parent' => 1,
                'deleted_at' => NULL,
                'created_at' => '2019-10-22 14:11:01',
                'updated_at' => '2019-10-22 14:11:01',
            ),
            10 => 
            array (
                'id' => 12,
                'parent_structure' => 5,
                'name' => 'Cafeteria',
                'reference' => 'Cafeteria',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-02-05 16:13:00',
                'updated_at' => '2020-02-05 16:13:00',
            ),
            11 => 
            array (
                'id' => 13,
                'parent_structure' => 5,
                'name' => 'Hostel',
                'reference' => 'Hostel',
                'is_parent' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-02-05 16:24:24',
                'updated_at' => '2020-02-05 16:24:24',
            ),
        ));
        
        
    }
}
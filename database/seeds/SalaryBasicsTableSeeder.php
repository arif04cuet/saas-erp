<?php

use Illuminate\Database\Seeder;

class SalaryBasicsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_basics')->delete();
        
        \DB::table('salary_basics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'payscale_id' => 1,
                'grade' => 1,
                'basic_salary' => 78000.0,
                'percentage_of_increment' => 0,
                'no_of_increment' => 0,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            1 => 
            array (
                'id' => 2,
                'payscale_id' => 1,
                'grade' => 2,
                'basic_salary' => 66000.0,
                'percentage_of_increment' => 3.75,
                'no_of_increment' => 4,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            2 => 
            array (
                'id' => 3,
                'payscale_id' => 1,
                'grade' => 3,
                'basic_salary' => 56500.0,
                'percentage_of_increment' => 4,
                'no_of_increment' => 7,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            3 => 
            array (
                'id' => 4,
                'payscale_id' => 1,
                'grade' => 4,
                'basic_salary' => 50000.0,
                'percentage_of_increment' => 4,
                'no_of_increment' => 9,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            4 => 
            array (
                'id' => 5,
                'payscale_id' => 1,
                'grade' => 5,
                'basic_salary' => 43000.0,
                'percentage_of_increment' => 4.5,
                'no_of_increment' => 11,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            5 => 
            array (
                'id' => 6,
                'payscale_id' => 1,
                'grade' => 6,
                'basic_salary' => 35500.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 13,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            6 => 
            array (
                'id' => 7,
                'payscale_id' => 1,
                'grade' => 7,
                'basic_salary' => 29000.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 16,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            7 => 
            array (
                'id' => 8,
                'payscale_id' => 1,
                'grade' => 8,
                'basic_salary' => 23000.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            8 => 
            array (
                'id' => 9,
                'payscale_id' => 1,
                'grade' => 9,
                'basic_salary' => 22000.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            9 => 
            array (
                'id' => 10,
                'payscale_id' => 1,
                'grade' => 10,
                'basic_salary' => 16000.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            10 => 
            array (
                'id' => 11,
                'payscale_id' => 1,
                'grade' => 11,
                'basic_salary' => 12500.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            11 => 
            array (
                'id' => 12,
                'payscale_id' => 1,
                'grade' => 12,
                'basic_salary' => 11300.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            12 => 
            array (
                'id' => 13,
                'payscale_id' => 1,
                'grade' => 13,
                'basic_salary' => 11000.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            13 => 
            array (
                'id' => 14,
                'payscale_id' => 1,
                'grade' => 14,
                'basic_salary' => 10200.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            14 => 
            array (
                'id' => 15,
                'payscale_id' => 1,
                'grade' => 15,
                'basic_salary' => 9700.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            15 => 
            array (
                'id' => 16,
                'payscale_id' => 1,
                'grade' => 16,
                'basic_salary' => 9300.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            16 => 
            array (
                'id' => 17,
                'payscale_id' => 1,
                'grade' => 17,
                'basic_salary' => 9000.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            17 => 
            array (
                'id' => 18,
                'payscale_id' => 1,
                'grade' => 18,
                'basic_salary' => 8800.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            18 => 
            array (
                'id' => 19,
                'payscale_id' => 1,
                'grade' => 19,
                'basic_salary' => 8500.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
            19 => 
            array (
                'id' => 20,
                'payscale_id' => 1,
                'grade' => 20,
                'basic_salary' => 8250.0,
                'percentage_of_increment' => 5,
                'no_of_increment' => 18,
                'deleted_at' => NULL,
                'created_at' => '2019-09-15 11:39:41',
                'updated_at' => '2019-10-13 11:17:31',
            ),
        ));
        
        
    }
}
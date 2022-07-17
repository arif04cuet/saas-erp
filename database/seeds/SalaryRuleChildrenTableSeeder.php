<?php

use Illuminate\Database\Seeder;

class SalaryRuleChildrenTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_rule_children')->delete();
        
        \DB::table('salary_rule_children')->insert(array (
            0 => 
            array (
                'id' => 1,
                'salary_rule_id' => 30,
                'child_rule_id' => 31,
                'created_at' => '2019-10-16 12:14:33',
                'updated_at' => '2019-10-16 12:14:33',
            ),
            1 => 
            array (
                'id' => 2,
                'salary_rule_id' => 30,
                'child_rule_id' => 32,
                'created_at' => '2019-10-16 12:14:33',
                'updated_at' => '2019-10-16 12:14:33',
            ),
            2 => 
            array (
                'id' => 3,
                'salary_rule_id' => 30,
                'child_rule_id' => 33,
                'created_at' => '2019-10-16 12:14:33',
                'updated_at' => '2019-10-16 12:14:33',
            ),
            3 => 
            array (
                'id' => 4,
                'salary_rule_id' => 39,
                'child_rule_id' => 3,
                'created_at' => '2019-10-28 15:31:23',
                'updated_at' => '2019-10-28 15:31:23',
            ),
            4 => 
            array (
                'id' => 5,
                'salary_rule_id' => 40,
                'child_rule_id' => 1,
                'created_at' => '2019-10-28 15:37:18',
                'updated_at' => '2019-10-28 15:37:18',
            ),
            5 => 
            array (
                'id' => 6,
                'salary_rule_id' => 40,
                'child_rule_id' => 3,
                'created_at' => '2019-10-28 15:37:18',
                'updated_at' => '2019-10-28 15:37:18',
            ),
            6 => 
            array (
                'id' => 7,
                'salary_rule_id' => 40,
                'child_rule_id' => 4,
                'created_at' => '2019-10-28 15:37:18',
                'updated_at' => '2019-10-28 15:37:18',
            ),
        ));
        
        
    }
}
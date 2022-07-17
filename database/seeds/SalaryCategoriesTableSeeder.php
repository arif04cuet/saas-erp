<?php

use Illuminate\Database\Seeder;

class SalaryCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_categories')->delete();
        
        \DB::table('salary_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Basic',
                'description' => 'Basic salary',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Allowance',
                'description' => 'Any kind of money for a purpose',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bonus',
                'description' => 'Bonus for any festival or performance',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Deduction',
                'description' => 'Any kind of deduction from salary',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Gross',
                'description' => 'Gross',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Net',
                'description' => 'Net',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Special social contribution',
                'description' => 'Special social contribution',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Misc',
                'description' => 'Misc',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
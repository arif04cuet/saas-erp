<?php

namespace Modules\Accounts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\SalaryCategory;

class SeedSalaryCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::table('salary_categories')->delete();

        \DB::table('salary_categories')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Basic',
                    'description' => 'Basic salary',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Allowance',
                    'description' => 'Any kind of money for a purpose',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Bonus',
                    'description' => 'Bonus for any festival or performance',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Deduction',
                    'description' => 'Any kind of deduction from salary',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Gross',
                    'description' => 'Gross',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Net',
                    'description' => 'Net',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Special social contribution',
                    'description' => 'Special social contribution',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Misc',
                    'description' => 'Misc',
                ),
        ));
    }
}

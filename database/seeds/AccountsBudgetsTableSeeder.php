<?php

use Illuminate\Database\Seeder;

class AccountsBudgetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('accounts_budgets')->delete();
        
        \DB::table('accounts_budgets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '২০১৯-২০২০ অর্থ বছরের বাজেট',
                'fiscal_year_id' => 3,
                'total_local' => NULL,
                'total_revenue' => NULL,
                'status' => 'draft',
                'created_at' => '2020-01-08 17:19:44',
                'updated_at' => '2020-01-08 17:19:44',
            ),
        ));
        
        
    }
}
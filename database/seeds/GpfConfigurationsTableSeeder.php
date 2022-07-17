<?php

use Illuminate\Database\Seeder;

class GpfConfigurationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('gpf_configurations')->truncate();
        
        \DB::table('gpf_configurations')->insert(array (
            0 => 
            array (
                'gpf_interest_percentage' => 13,
                'gpf_loan_interest_percentage' => 13,
                'min_gpf_percentage' => 10,
                'max_gpf_percentage' => 25,
                'max_loan_installment' => 50,
                'status' => 1,
                'remark' => 'Generic configuration',
            ),
        ));
        
        
    }
}
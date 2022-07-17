<?php

use Illuminate\Database\Seeder;

class EmployeePublicationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employee_publications')->delete();
        
        
        
    }
}
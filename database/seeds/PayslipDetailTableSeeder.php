<?php

use Illuminate\Database\Seeder;

class PayslipDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('payslip_details')->delete();
        //
    }
}

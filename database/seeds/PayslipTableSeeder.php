<?php

use Illuminate\Database\Seeder;

class PayslipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('payslips')->delete();
        //
    }
}

<?php

use Illuminate\Database\Seeder;

class PayslipBatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('payslip_batches')->delete();
    }
}

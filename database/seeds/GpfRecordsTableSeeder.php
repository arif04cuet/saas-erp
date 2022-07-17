<?php

use Illuminate\Database\Seeder;

class GpfRecordsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('gpf_records')->truncate();

        $contracts = DB::table('employee_contracts')->get();
        $data = [];
        foreach ($contracts as $key => $contract) {
            $stockBalance = rand(100000, 999999);
            $data [$key] = [
                'employee_id' => $contract->employee_id,
                'fund_number' => $key.rand(1,999),
                'stock_balance' => $stockBalance,
                'current_balance' => $stockBalance,
                'current_percentage' => ($contract->salary_grade < 9)? 25 : [10,15,20,25][rand(0, 3)],
                'remark' => 'Auto Generated for '. $contract->reference,
                'start_date' => date('Y-m-d',
                    strtotime(rand(1999, date('Y')).'-'.rand(1,12).'-'.rand(1,27))),
                'settlement_date' => NULL,
                'status' => 'active',
                'created_at' => date('Y-m-d'),
            ];
        }

        \DB::table('gpf_records')->insert($data);
    }
}
<?php

use Illuminate\Database\Seeder;

class TmsAdvancePaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tms_advance_payments')->delete();
        
        \DB::table('tms_advance_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'employee_id' => 10,
                'training_id' => 1,
                'tms_journal_entry_id' => 6,
                'total_debit_amount' => 100000.0,
                'total_credit_amount' => 0.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:23:28',
                'updated_at' => '2020-05-04 12:23:28',
            ),
            1 => 
            array (
                'id' => 2,
                'employee_id' => 10,
                'training_id' => 1,
                'tms_journal_entry_id' => 7,
                'total_debit_amount' => 0.0,
                'total_credit_amount' => 500.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:27:01',
                'updated_at' => '2020-05-04 12:27:01',
            ),
            2 => 
            array (
                'id' => 3,
                'employee_id' => 1,
                'training_id' => 1,
                'tms_journal_entry_id' => 8,
                'total_debit_amount' => 10000.0,
                'total_credit_amount' => 0.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:28:57',
                'updated_at' => '2020-05-04 12:28:57',
            ),
            3 => 
            array (
                'id' => 4,
                'employee_id' => 1,
                'training_id' => 1,
                'tms_journal_entry_id' => 9,
                'total_debit_amount' => 0.0,
                'total_credit_amount' => 800.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:30:27',
                'updated_at' => '2020-05-04 12:30:27',
            ),
        ));
        
        
    }
}
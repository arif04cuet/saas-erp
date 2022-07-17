<?php

use Illuminate\Database\Seeder;

class TmsCashBookEntriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tms_cash_book_entries')->delete();
        
        \DB::table('tms_cash_book_entries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 2,
                'payment_type' => 'bank',
                'amount' => 1000.0,
                'date' => '2020-05-03',
                'status' => 'draft',
                'created_at' => '2020-05-03 16:06:38',
                'updated_at' => '2020-05-03 16:06:38',
            ),
            1 => 
            array (
                'id' => 2,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 5,
                'payment_type' => 'bank',
                'amount' => 103234.0,
                'date' => '2020-05-03',
                'status' => 'draft',
                'created_at' => '2020-05-03 16:15:13',
                'updated_at' => '2020-05-03 16:15:13',
            ),
            2 => 
            array (
                'id' => 3,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 7,
                'payment_type' => 'bank',
                'amount' => 100.0,
                'date' => '2020-05-03',
                'status' => 'draft',
                'created_at' => '2020-05-03 17:19:06',
                'updated_at' => '2020-05-03 17:19:06',
            ),
            3 => 
            array (
                'id' => 4,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 9,
                'payment_type' => 'cash',
                'amount' => 100000.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:23:28',
                'updated_at' => '2020-05-04 12:23:28',
            ),
            4 => 
            array (
                'id' => 5,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 11,
                'payment_type' => 'cash',
                'amount' => 500.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:27:01',
                'updated_at' => '2020-05-04 12:27:01',
            ),
            5 => 
            array (
                'id' => 6,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 14,
                'payment_type' => 'cash',
                'amount' => 10000.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:28:57',
                'updated_at' => '2020-05-04 12:28:57',
            ),
            6 => 
            array (
                'id' => 7,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 17,
                'payment_type' => 'cash',
                'amount' => 800.0,
                'date' => '2020-05-04',
                'status' => 'draft',
                'created_at' => '2020-05-04 12:30:27',
                'updated_at' => '2020-05-04 12:30:27',
            ),
            7 => 
            array (
                'id' => 8,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 20,
                'payment_type' => 'cash',
                'amount' => 700.0,
                'date' => '2020-05-05',
                'status' => 'draft',
                'created_at' => '2020-05-05 19:31:12',
                'updated_at' => '2020-05-05 19:31:12',
            ),
            8 => 
            array (
                'id' => 9,
                'training_id' => 1,
                'tms_journal_entry_detail_id' => 23,
                'payment_type' => 'cash',
                'amount' => 36545.0,
                'date' => '2020-05-05',
                'status' => 'draft',
                'created_at' => '2020-05-05 19:42:47',
                'updated_at' => '2020-05-05 19:42:47',
            ),
            9 => 
            array (
                'id' => 10,
                'training_id' => 2,
                'tms_journal_entry_detail_id' => 27,
                'payment_type' => 'bank',
                'amount' => 20500.0,
                'date' => '2020-05-05',
                'status' => 'draft',
                'created_at' => '2020-05-05 20:54:12',
                'updated_at' => '2020-05-05 20:54:12',
            ),
            10 => 
            array (
                'id' => 11,
                'training_id' => 2,
                'tms_journal_entry_detail_id' => 30,
                'payment_type' => 'bank',
                'amount' => 46000.0,
                'date' => '2020-05-07',
                'status' => 'draft',
                'created_at' => '2020-05-07 19:24:52',
                'updated_at' => '2020-05-07 19:24:52',
            ),
            11 => 
            array (
                'id' => 12,
                'training_id' => 2,
                'tms_journal_entry_detail_id' => 33,
                'payment_type' => 'bank',
                'amount' => 8534.0,
                'date' => '2020-05-07',
                'status' => 'draft',
                'created_at' => '2020-05-07 19:44:28',
                'updated_at' => '2020-05-07 19:44:28',
            ),
            12 => 
            array (
                'id' => 13,
                'training_id' => 10,
                'tms_journal_entry_detail_id' => 35,
                'payment_type' => 'cash',
                'amount' => 100000.0,
                'date' => '2020-05-18',
                'status' => 'draft',
                'created_at' => '2020-05-18 21:04:55',
                'updated_at' => '2020-05-18 21:04:55',
            ),
        ));
        
        
    }
}
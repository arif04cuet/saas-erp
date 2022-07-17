<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JournalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('journals')->truncate();

        DB::table('journals')->insert([
            '0' => [
                'id' => 1,
                'name' => 'Sale Journal',
                'debit_account_id' => 3111101,
                'credit_account_id' => 3111201,
                'type_id' => 1,
                'department_id' => 9,
            ],
            '1' => [
                'id' => 2,
                'name' => 'Purchase Journal',
                'debit_account_id' => 3111101,
                'credit_account_id' => 3111201,
                'type_id' => 2,
                'department_id' => 9,
            ],
            '2' => [
                'id' => 3,
                'name' => 'Sale Journal',
                'debit_account_id' => 3111101,
                'credit_account_id' => 3111201,
                'type_id' => 1,
                'department_id' => 8,
            ],
            '3' => [
                'id' => 4,
                'name' => 'Training  Journal',
                'debit_account_id' => 3111101,
                'credit_account_id' => 3111201,
                'type_id' => 1,
                'department_id' => 7,
            ],
        ]);
    }
}

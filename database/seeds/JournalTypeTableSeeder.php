<?php

use Illuminate\Database\Seeder;

class JournalTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('journal_types')->delete();
        \DB::table('journal_types')->insert(array(

            0 => [
                'id' => 1,
                'name' => 'Sale'
            ],
            1 => [
                'id' => 2,
                'name' => 'Purchase'
            ],
            2 => [
                'id' => 3,
                'name' => 'Cash'
            ],
            3 => [
                'id' => 4,
                'name' => 'Bank'
            ],
            4 => [
                'id' => 5,
                'name' => 'Others'
            ],
        ));
    }
}

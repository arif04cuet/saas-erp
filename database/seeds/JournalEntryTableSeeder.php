<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Accounts\Entities\JournalEntry;

class JournalEntryTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('journal_entries')->delete();
        DB::table('journal_entries')->insert([
            
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class NotesTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('notes_type')->delete();
        \DB::table('notes_type')->insert(array(

            0 => [
                'id' => 1,
                'name' => 'Type 1'
            ],
            1 => [
                'id' => 2,
                'name' => 'Type 2'
            ],
            2 => [
                'id' => 3,
                'name' => 'Type 3'
            ],
            3 => [
                'id' => 4,
                'name' => 'Type 4'
            ]
        ));

    }
}
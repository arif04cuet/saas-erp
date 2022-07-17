<?php

use Illuminate\Database\Seeder;

class TaskCommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('task_comments')->delete();
        
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class AnnualTrainingNotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('annual_training_notifications')->delete();
        
        \DB::table('annual_training_notifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'year' => '2019-2020',
                'attachment' => NULL,
                'attachment_file_name' => NULL,
                'note' => 'Annual Training Notification',
                'send_to_divisional_director' => 1,
                'created_at' => '2020-05-18 19:11:23',
                'updated_at' => '2020-05-18 19:11:23',
            ),
            1 => 
            array (
                'id' => 2,
                'year' => '2020-2021',
                'attachment' => 'annual-training-notification/lIOHUcLPa3cdQ5l1aSAz7txeWuEDvWeJqfmgKTcl.pdf',
            'attachment_file_name' => 'Deliverables of 18th May, 2020 (1).pdf',
                'note' => 'Annual Training Notification 1',
                'send_to_divisional_director' => 0,
                'created_at' => '2020-05-19 12:44:06',
                'updated_at' => '2020-05-19 12:44:06',
            ),
            2 => 
            array (
                'id' => 3,
                'year' => '2019-2020',
                'attachment' => 'annual-training-notification/Y252l6kXjEZVBeVwt5DUgrtW6nqEvqzFARW31sRr.pdf',
            'attachment_file_name' => 'Deliverables of 18th May, 2020 (1).pdf',
                'note' => 'Annual Training Notification 2',
                'send_to_divisional_director' => 1,
                'created_at' => '2020-05-19 12:44:34',
                'updated_at' => '2020-05-19 12:44:34',
            ),
            3 => 
            array (
                'id' => 4,
                'year' => '2019-2020',
                'attachment' => 'annual-training-notification/6rLxjjnUP554dHv0NyAVI5tJykZSVrVoiv2ad7rI.xlsx',
            'attachment_file_name' => 'import_trainee-2 (6).xlsx',
                'note' => 'Annual Training Notification 4',
                'send_to_divisional_director' => 1,
                'created_at' => '2020-05-19 12:54:12',
                'updated_at' => '2020-05-19 12:54:12',
            ),
        ));
        
        
    }
}
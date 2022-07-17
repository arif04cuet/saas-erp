<?php

use Illuminate\Database\Seeder;

class AnnualTrainingNotificationResponsesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('annual_training_notification_responses')->delete();
        
        \DB::table('annual_training_notification_responses')->insert(array (
            0 => 
            array (
                'id' => 2,
                'annual_training_notification_organization_id' => 2,
                'annual_training_notification_id' => 1,
                'user_id' => NULL,
                'type' => 'organization',
                'title' => '70th Foundation Training Course',
                'no_of_trainee' => 100,
            'participant_type' => 'Officials of BCS (All cadres)',
                'start_date' => '2020-07-01',
                'end_date' => '2020-12-31',
                'remark' => 'N/A',
                'created_at' => '2020-05-18 19:15:17',
                'updated_at' => '2020-05-18 19:15:17',
            ),
            1 => 
            array (
                'id' => 3,
                'annual_training_notification_organization_id' => 2,
                'annual_training_notification_id' => 1,
                'user_id' => NULL,
                'type' => 'organization',
            'title' => 'BARD attachment program (RDA,BIAM)',
                'no_of_trainee' => 100,
            'participant_type' => 'Officials of BCS (All cadres)',
                'start_date' => '2020-06-01',
                'end_date' => '2020-12-31',
                'remark' => 'N/A',
                'created_at' => '2020-05-18 19:15:17',
                'updated_at' => '2020-05-18 19:15:17',
            ),
            2 => 
            array (
                'id' => 4,
                'annual_training_notification_organization_id' => 2,
                'annual_training_notification_id' => 1,
                'user_id' => NULL,
                'type' => 'organization',
                'title' => 'Attachment Programme on Poverty Reduction and Rural Development',
                'no_of_trainee' => 70,
            'participant_type' => 'Officials of BCS (All cadres)',
                'start_date' => '2020-07-01',
                'end_date' => '2021-06-30',
                'remark' => 'N/A',
                'created_at' => '2020-05-18 19:15:17',
                'updated_at' => '2020-05-18 19:15:17',
            ),
            3 => 
            array (
                'id' => 6,
                'annual_training_notification_organization_id' => 1,
                'annual_training_notification_id' => 1,
                'user_id' => NULL,
                'type' => 'organization',
                'title' => 'Workshop on RDCD Training Management System & ERP Requirement Analysis',
                'no_of_trainee' => 50,
            'participant_type' => 'Officials of BCS (All cadres)',
                'start_date' => '2020-08-01',
                'end_date' => '2020-08-31',
                'remark' => 'N/A',
                'created_at' => '2020-05-18 19:20:25',
                'updated_at' => '2020-05-18 19:20:25',
            ),
            4 => 
            array (
                'id' => 7,
                'annual_training_notification_organization_id' => 1,
                'annual_training_notification_id' => 1,
                'user_id' => NULL,
                'type' => 'organization',
                'title' => 'Attachment Program on Poverty Reduction and Rural Development',
                'no_of_trainee' => 100,
            'participant_type' => 'Officials of BCS (All cadres)',
                'start_date' => '2020-06-01',
                'end_date' => '2021-06-30',
                'remark' => 'N/A',
                'created_at' => '2020-05-18 19:20:25',
                'updated_at' => '2020-05-18 19:20:25',
            ),
            5 => 
            array (
                'id' => 8,
                'annual_training_notification_organization_id' => NULL,
                'annual_training_notification_id' => 1,
                'user_id' => 12,
                'type' => 'user',
                'title' => 'Introduction to computer',
                'no_of_trainee' => 120,
                'participant_type' => 'Information Service Providers',
                'start_date' => '2020-06-01',
                'end_date' => '2020-07-31',
                'remark' => 'N/A',
                'created_at' => '2020-05-18 19:21:42',
                'updated_at' => '2020-05-18 19:21:42',
            ),
        ));
        
        
    }
}
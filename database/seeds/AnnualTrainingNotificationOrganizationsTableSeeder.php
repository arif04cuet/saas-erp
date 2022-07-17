<?php

use Illuminate\Database\Seeder;

class AnnualTrainingNotificationOrganizationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('annual_training_notification_organizations')->delete();
        
        \DB::table('annual_training_notification_organizations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'annual_training_notification_id' => 1,
                'training_organization_id' => 1,
                'unique_key' => '200518-15728-5ec28980b307f',
                'date_of_response' => '2020-05-18 19:20:25',
                'last_date_of_response' => '2020-05-25',
                'status' => 'responded',
                'created_at' => '2020-05-18 19:11:28',
                'updated_at' => '2020-05-18 19:20:25',
            ),
            1 => 
            array (
                'id' => 2,
                'annual_training_notification_id' => 1,
                'training_organization_id' => 2,
                'unique_key' => '200518-29795-5ec28981c3b5c',
                'date_of_response' => '2020-05-18 19:15:17',
                'last_date_of_response' => '2020-05-25',
                'status' => 'responded',
                'created_at' => '2020-05-18 19:11:29',
                'updated_at' => '2020-05-18 19:15:17',
            ),
            2 => 
            array (
                'id' => 3,
                'annual_training_notification_id' => 2,
                'training_organization_id' => 1,
                'unique_key' => '200519-93881-5ec3803643fb2',
                'date_of_response' => NULL,
                'last_date_of_response' => '2020-05-26',
                'status' => 'pending',
                'created_at' => '2020-05-19 12:44:06',
                'updated_at' => '2020-05-19 12:44:06',
            ),
            3 => 
            array (
                'id' => 4,
                'annual_training_notification_id' => 3,
                'training_organization_id' => 1,
                'unique_key' => '200519-93305-5ec38056bf881',
                'date_of_response' => NULL,
                'last_date_of_response' => '2020-05-26',
                'status' => 'pending',
                'created_at' => '2020-05-19 12:44:38',
                'updated_at' => '2020-05-19 12:44:38',
            ),
            4 => 
            array (
                'id' => 5,
                'annual_training_notification_id' => 3,
                'training_organization_id' => 2,
                'unique_key' => '200519-69541-5ec38057c556a',
                'date_of_response' => NULL,
                'last_date_of_response' => '2020-05-26',
                'status' => 'pending',
                'created_at' => '2020-05-19 12:44:39',
                'updated_at' => '2020-05-19 12:44:39',
            ),
            5 => 
            array (
                'id' => 6,
                'annual_training_notification_id' => 4,
                'training_organization_id' => 1,
                'unique_key' => '200519-87814-5ec38299389ce',
                'date_of_response' => NULL,
                'last_date_of_response' => '2020-05-26',
                'status' => 'pending',
                'created_at' => '2020-05-19 12:54:17',
                'updated_at' => '2020-05-19 12:54:17',
            ),
        ));
        
        
    }
}
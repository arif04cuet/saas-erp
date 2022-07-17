<?php

use Illuminate\Database\Seeder;

class NotificationTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('notification_types')->delete();

        \DB::table('notification_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Research Proposal Notification',
                    'description' => 'Notification for any activity regrading research proposal',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Project Proposal Submission',
                    'description' => 'Notification for any activity regrading project proposal',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'IMS WORKFLOW',
                    'description' => 'Notification for any activity regrading ims workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'IMS AUCTION WORKFLOW',
                    'description' => 'Notification for any activity regrading ims workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'HRM LEAVE REQUEST WORKFLOW',
                    'description' => 'Notification for any activity regrading ims workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'HRM CIRCULAR',
                    'description' => 'Notification for any activity regrading ims workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'HRM COMPLAINT',
                    'description' => 'Notification for any activity regrading hrm complaint workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'HRM COMPLAINT INVITATION',
                    'description' => 'Notification for any activity regrading hrm complaint invitation workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'HRM APPRAISAL REQUEST',
                    'description' => 'Notification for any activity regrading hrm appraisal request workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'EXCEL EXPORT FINISHED',
                    'description' => 'Notification Regarding Excel Export Finish',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => 'TMS COURSE ADMINISTRATION',
                    'description' => 'Notification for any activity regrading tms course administration',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => 'VMS TRIP REQUEST',
                    'description' => 'Notification for vehicle trip request',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2019-06-18 10:24:00',
                    'updated_at' => null,
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => 'VMS FUEL BILL SUBMIT REQUEST',
                    'description' => 'Notification for vehicle fuel bill submit request',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2020-09-01 11:24:00',
                    'updated_at' => null,
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => 'VMS MAINTENANCE REQUISITION REQUEST',
                    'description' => 'Notification for maintenance requisition request',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2020-09-01 11:24:00',
                    'updated_at' => null,
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'HOSTEL BUDGET SUBMISSION',
                    'description' => 'Notification for hostel budget submission',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2020-09-01 11:24:00',
                    'updated_at' => null,
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'INVENTORY ITEM REQUEST',
                    'description' => 'Inventory Item Request Workflow',
                    'is_application_notification' => 1,
                    'is_email_notification' => 0,
                    'is_sms_notification' => 0,
                    'icon_name' => '',
                    'created_at' => '2020-09-01 11:24:00',
                    'updated_at' => null,
                )
        ));


    }
}

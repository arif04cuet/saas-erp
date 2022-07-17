<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 8/1/19
 * Time: 11:21 AM
 */

return [
    'title' => 'Annual Training Notification',
    'menu_title' => 'Annual Notification',
    'create_notification' => 'Annual Training Notification Create',
    'organization' => 'Organization',
    'attachment' => 'Attachment',
    'note' => 'Note',
    'list' => 'Annual Training Notification List',
    'email' => 'Email',
    'email_body' => 'Email Body',
    'organization_name' => 'Organization Name',
    'notified_date' => 'Notify Date',
    'responded_time' => 'Response Date',
    'add_response' => 'Add Response',
    'view_response' => 'View Response',
    'total_response' => 'Total Response',
    'create_button' => 'New Notification',
    'year' => 'Year',
    'send_dd' => 'Include Divisional Directors',
    'dds' => 'Divisional Directors',
    'dd_name' => 'Divisional Director',
    'department' => 'Department',
    'preview_button' => 'Email Preview',
    'preview' => 'Training Notification Email Preview',
    'confirmation' => 'The Notification will be sent through email to the mentioned participant. Sure to continue?',
    'email_content' => [
        'initials' => ' Please follow the link here :url to give your response or send email
            with the format mentioned in the following letter.',
        'subject' => 'Subject: Training Demand for Next Financial Year',
        'body' => 'Bangladesh Academy for Rural Development (BARD) is going to organize its Annual Planning
            Conference for evaluating its performance of previous year and formulating its plan for next years. In this
            connection it will be highly appreciated if you kindly let us know your plan to organise training course at
            BARD during July 2020 to June 2021 by filling the following format. You are also requested to send your
            demand by <strong>:date</strong>',
        'footer' => 'Thanking you in anticipation.',
    ],

    'response' => [
        'title' => 'Annual Training Notification Response',
        'menu_title' => 'Annual Training Notification Response',
        'index' => 'Annual Training Notification Response List',
        'expired_message' => 'Sorry ! Submission Date Has Expired',
        'form_elements' => [
            'title' => trans('labels.title'),
            'repeater_title' => 'Training Information',
            'organization' => 'Organization',
            'no_of_trainee' => 'Number of Participants',
            'participant_type' => 'Participant Type',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'remark' => trans('labels.remarks'),
            'status' => trans('labels.status'),
        ]
    ],
    'file' => 'File',
];

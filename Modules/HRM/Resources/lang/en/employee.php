<?php
return [
    'menu_name' => 'Employee',
    'list_title' => 'Employee Info',
    'add_employee' => 'Add Employee ',
    'edit_employee' => 'Edit Employee',
    'employee_details' => 'Employee Details',
    'employee_id' => 'Employee Id',
    'date_of_retirement' => 'Date at 59 years old',

    // Employee Loan
    'loan' => [
        'title' => 'Employee Loan',
        'apply' => 'Apply for Loan',
        'applicant' => 'Loan Applicant',
        'form' => 'Loan Application Form',
        'info' => 'Loan Details',
        'type' => 'Loan Type',
        'types' => [
            'house' => 'House Loan',
            'house_repair' => 'House Repair Loan',
            'motorcycle' => 'Motorcycle Loan',
            'car' => 'Car Loan',
            'computer' => 'Computer Loan',
        ],
        'amount' => 'Amount (Taka)',
        'installment' => 'No. of Installment',
        'reason' => 'Reason of Loan',
        'select_type' => 'Select Loan Type',
        'apply_date' => 'Loan Application Date',
        'apply_button' => 'Apply Loan',
        'approve_form' => 'Loan Approval Form',
        'reference_no' => 'e-Nothi Reference No.',
        'previous_loan' => 'Any Previous Loan History?',
        'previous_loan_tick' => 'If any Tick Sector Wise',
        'association_loan' => 'Any Loan in Employee Association',
        'loan_amount' => 'Amount in Taka on Application Date',
        'bank_name' => 'Bank Name',
        'bank_loan' => 'Any Loan In Bank?',

        'circular' => [
            'title' => 'Loan Circular',
            'loan_circular_title' => 'Loan Circular Title',
            'index' => 'Loan Circular List',
            'form' => 'Loan Circular Form',
            'create' => 'Create Loan Circular',
            'reference_no' => 'Reference No',
            'circular_date' => 'Loan Circular Date',
            'last_date_of_application' => 'Last Date of Application',
            'warning' => 'No Active Loan Circular is Found to Apply Loan'
        ]
    ],

    // Employee Training
    'employee_training' => 'Employee Training',
    'employee_training_apply' => 'Training Application',
    'employee_training_apply_btn' => 'Apply Training',
    'employee_training_apply_form' => 'Training Application Form',
    'training_list' => 'Training List',
    'trainee_card_title' => 'Trainee List',
    'create_button' => 'New Training',
    'update_button' => 'Update Training',
    'create_card_title' => 'Create Training',
    'create_form_title' => 'Training Form',
    'create_trainee_form_title' => 'Trainee Add Form',
    'edit_trainee_form_title' => 'Edit Trainee Form',
    'show_form_title' => 'Training Information',
    'edit_card_title' => 'Update Training',
    'edit_form_title' => 'Update Training Form',
    'start_date' => 'Start From',
    'end_date' => 'End on',
    'training_id' => 'Training ID',
    'training_name' => 'Training Title',
    'select_training' => 'Select Training',
    'no_permission_for_training' => 'Sorry! You do not have permission to add training',

    // Employee Attendance
    'attendance' => 'Attendance',
    'attendance_list' => 'Attendance List',
    'in_time' => 'In Time',
    'out_time' => 'Out Time',
    'working_hour' => 'Working Hour',

    // Employee Punishment
    'employee_punishment' => 'Employee Punishment',
    'employee_punishment_list' => 'Punishment List',
    'employee_punishment_type' => 'Punishment Type',
    'select_employee_punishment_type' => 'Select Punishment Type',
    'punishment_start' => 'Punishment Start',
    'punishment_end' => 'Punishment End',
    'punishment_duration' => 'Punishment Duration',
    'new_punishment_record' => 'Punishment Record',
    'new_punishment_record_form' => 'Punishment Record Form',
    'new_punishment_record_submit' => 'Record Punishment',
    'punishment_reason' => 'Reason of Punishment',
    'punishment_reason_placeholder' => 'Reason of Punishment',
    'show_punishment' => 'Show Punishment',

    // CV Evaluation
    'cv' => 'CV',
    'cv_evaluation' => 'CV Evaluation',
    'cv_list' => 'CV List',
    'applicant_name' => 'Applicant Name',
    'post_title' => 'Post Title',
    'year_of_experience' => 'Experience (Year)',
    'apply_date' => 'Apply Date',
    'marks' => 'Give Marks',
    'submit_marks' => 'Submit Mark',
    'comment' => 'Comment',
    'shortlist' => 'Shortlist',

    // Employee From Validation
    'employee_id_validation' => 'Genearal Information should be filled first',
    'no_training_info' => 'Training information does not exist',
    'no_edu_info' => 'Educational information does not exist',
    'religion' => [
        'title' => 'Religion',
        'table' => [
            'columns' => [
                'bengali_name' => [
                    'title' => 'Title (Bengali)',
                ],
                'english_name' => [
                    'title' => 'Title (English)',
                ],
            ],
        ],
        'page' => [
            'create' => [
                'title' => 'Add Religion',
            ],
            'show' => [
                'title' => 'Religion Details',
            ],
            'edit' => [
                'title' => 'Update Religion',
            ],
        ],
        'form' => [
            'heading' => [
                'title' => 'ধর্ম ফর্ম',
            ],
            'labels' => [
                'bengali_title' => 'Title (Bengali)',
                'english_title' => 'Title (English)',
                'description' => 'Description',
            ],
        ],
        'locale' => 'english_title',
    ],
    'is_dead' => 'Is Dead?',
    'name' => [
        'locale' => 'english',
    ],
];

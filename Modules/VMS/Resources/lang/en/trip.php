<?php

return [
    'title' => 'Trip',
    'create' => 'Create Trip',
    'index' => 'Trip List',
    'menu_title' => 'Trip',
    'details' => 'Trip Details',
    'feedback' => 'Feedback',
    'allocated' => 'Allocate',
    'previous_trip_title' => 'Trip History (Recent Month)',
    'apply' => [
        'menu_title' => 'Apply for a trip',
        'index' => '',
        'form_elements' => [
        ]
    ],
    'type' => [
        'title' => 'Type',
        'official' => 'Official',
        'training' => 'Training',
        'personal' => 'Personal',
        'project' => 'Project'
    ],
    'distance' => [
        'below_25' => 'Below 25 Km',
        'above_25' => 'Over 25 KM'
    ],
    'form_elements' => [
        'requester_id' => 'Requester',
        'billed_to' => 'Billed To',
        'type' => 'Type',
        'start_date_time' => 'Trip Date & Time',
        'end_date_time' => 'Trip Return Date & Time',
        'no_of_passenger' => 'No of Passenger',
        'passengers' => 'Passengers',
        'is_requester_passenger' => 'Include Myself As Passenger',
        'destination' => 'Destination',
        'distance' => 'Distance (in Km)',
        'reason' => 'Reason',
        'length' => 'Trip Length (Hours)'
    ],
    'status' => [
        'all' => 'All',
        'pending' => 'Pending',
        'rejected' => 'Rejected',
        'cancelled' => 'Cancelled',
        'approved' => 'Approved',
        'ongoing' => 'Ongoing',
        'completed' => 'Completed',
    ],
    'notification_messages' => [
        'start' => 'A Vehicle Trip Request Has Made By :name',
        'approved' => 'Your Trip Request Has Been Approved',
        'rejected' => 'Your Trip Request Has Been Rejected',
        'begin' => 'Your Trip Has Started',
        'completed' => 'Your Trip Has Been Completed',
        'cancelled' => 'Your Trip Request Has Been Cancelled',
        'ongoing' => 'Your Trip Is Marked As On-Going!',
        'pending' => 'Your Trip Request Is Pending',
        'update_trip_message' => 'Your Trip DateTime Has Been Changed By Superviser',
        'workflow_message' => 'Request Has Been Sent To :name'
    ],
    'feedback' => [
        'title' => 'Feedback',
        'create' => 'Create Feedback',
        'form_elements' => [
            'actual_start_date_time' => 'Actual Start Time',
            'actual_end_date_time' => 'Actual End Date Time',
            'trip_length_hour' => 'Total Trip Period (Hours)',
            'completed_distance' => 'Completed Distance'
        ]
    ],
    'setting' => [
        'title' => 'Trip Calculation Setting',
        'menu_title' => 'Calculation Setting',
        'exceed_title' => 'Trip Calculation Exceed Setting ',
        'create' => 'Create Setting',
        'form_elements' => [
            'per_km_taka' => 'Per Km Taka',
            'per_hour_taka' => 'Per Hour Taka',
            'oil_price' => 'Oil Price',
            'gas_price' => 'Gas Price',
            'is_exceed_setting' => 'Exceed Setting',
        ]
    ],
    'bill' => [
        'title' => 'Trip Bill',
        'menu_title' => 'Trip Bill',
        'show' => 'View Bill',
        'details' => 'Bill Details',
        'calculation' => 'Calculation',
        'payment_title' => 'Payment Options',
        'monthly_bill' => 'Monthly Bill (Personal)',
        'payment_option' => [
            'payroll' => 'Add Bill To Payroll',
            'accounts' => 'Payment Complete',
            'tms_accounts' => 'Send To TMS',
            'project' => 'Send to PMS',
        ],
        'payment_status' => [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'partially_paid' => 'Partially Paid',
        ],
        'labels' => [
            'add_to_payroll' => 'Add Bill To Payroll',
            'mark_as_paid' => 'Payment Complete',
            'pay_to_training' => 'Send To TMS',
            'pay_to_project' => 'Send to PMS',
            'payment' => 'payment',
        ],
        'submission' => [
            'title' => 'Monthly Bill Submission',
            'trip_bill' => 'Due Trip Bill',
            'sector_bill' => 'Due Fixed Bill'
        ],
        'flash_messages' => [
            'payment_error' => 'Payment Failed',
            'payment_success' => 'Payment is Successful',
            'show_official_error' => 'Official Trip Does Not Require Billing'
        ]
    ],
    'limit' => [
        'title' => 'Trip Limit',
        'create' => 'Create Trip Limit',
        'edit' => 'Edit Trip Limit',
        'crossed_limits' => 'Trip Limit Exceed ?',
        'index' => 'Trip Limit List',
        '1' => 'Yes',
        '0' => 'No',
        'form_elements' => [
            'designation_id' => 'Designation',
            'limit' => 'Limit'
        ],
        'flash_messages' => [
            'trip_limit_crossed' => 'Requester Has Crossed Maximum Trip Limit For This Month !'
        ]
    ],
    'flash_messages' => [
        'vehicle_selection_error' => 'Please Select A Vehicle !',
        'vehicle_already_allocated_time_error'=>'Sorry ! This Vehicle Is Already Booked From :start To :end Time.'
    ]
];

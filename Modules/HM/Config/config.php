<?php

return [
    'name' => 'HM',
    'code' => 'HD',
    'roomStatus' => ['available', 'unavailable', 'partially-available'],
    'roomStatuses' => [
        '1' => 'available',
        '2' => 'unavailable',
        '3' => 'partially_available',
        '4' => 'not-in-service',
    ],
    'booking_guest_info' => [
        'gender' => [
            'male',
            'female'
        ],
        'default_nationality' => trans('hm::booking-request.bengali')
    ],
    'booking_types' => [
        'general' => 'general',
        'training' => 'training',
        'venue' => 'venue',
        'physical_facility' => 'physical_facility'
    ],
    'hostel_budget' => [
        'notification' => [
            'directorgeneral' => 'directorgeneral',
            'directoradmin' => 'directoradmin'
        ]
    ],
    'accounts' => [
        'section' => [
            'type_en' => [
                'income' => 'Income',
                'expense' => 'Expense'
            ],
            'type_bn' => [
                'income' => 'আয়',
                'expense' => 'ব্যয়'
            ],

        ],
        'statuses' => [
            'en' => [
                'draft' => 'Draft',
                'approved' => 'Approved',
                'rejected' => 'Rejected'
            ],
            'bn' => [
                'draft' => 'খসড়া',
                'approved' => 'অনুমোদিত',
                'rejected' => 'প্রত্যাখ্যাত'
            ]
        ]
    ]

];

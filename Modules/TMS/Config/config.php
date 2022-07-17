<?php
return [
    'name' => 'TMS',
    'code' => 'TD', // according to department table seeder
    'options' => [
        'Excellent' => 5,
        'Good' => 4,
        'Average' => 3,
        'Poor' => 2,
        'Very Poor' => 1,
    ],
    'training' => [
        'statuses' => [
            'draft' => 'draft',
            'published' => 'published',
            'running' => 'running',
            'completed' => 'completed',
            'upcoming' => 'upcoming'
        ],
        'level' => [
            'national' => 'national',
            'international' => 'international',
        ],
        'through_training' => [
            'offline' => 'offline',
            'online' => 'online',
        ],
        'accommodation_type' => [
            'residential' => 'residential',
            'non-residential' => 'non-residential',
        ],
        'enroll_type' => [
            'self' => 'self',
            'manual' => 'manual',
        ]
    ],
    'trainee' => [
        'language_preference' => [
            'both' => 'both',
            'only_english' => 'only_english',
            'only_bangla' => 'only_bangla'
        ]
    ],
    'constants' => [
        'accounts' => [
            'journal_entry' => [
                'form_elements' => [
                    'dropdowns' => [
                        'transaction_type' => [
                            'receive' => 'Receipt',
                            'payment' => 'Payment'
                        ],
                        'transaction_type_bn' => [
                            'receive' => 'প্রাপ্তি',
                            'payment' => 'প্রদান'
                        ],
                        'payment_type' => [
                            'bank' => 'Bank',
                            'cash' => 'Cash'
                        ],
                        'payment_type_bn' => [
                            'bank' => 'ব্যাংক',
                            'cash' => 'নগদ'
                        ],
                        'statuses' => [
                            'draft' => 'Draft',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected'
                        ],
                        'statuses_bn' => [
                            'draft' => 'খসড়া',
                            'approved' => 'অনুমোদিত',
                            'rejected' => 'প্রত্যাখ্যাত'
                        ]
                    ]
                ],
            ],
            'statuses' => [
                'draft',
                'approved',
                'rejected'
            ],
            'transaction_type' => [
                'receive',
                'payment'
            ],
            'payment_type' => [
                'cash',
                'bank'
            ],
            'code_setting' => [
                'statuses' => [
                    'active' => 'Active',
                    'inactive' => 'Inactive'
                ]
            ]
        ],
        'annual_training' => [
            'notification' => [
                'response' => [
                    'type' => [
                        'organization' => 'Organization',
                        'user' => 'User'
                    ]
                ],
                'statuses' => [
                    'pending' => 'Pending',
                    'responded' => 'Responded',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'cancelled' => 'Cancelled'
                ]
            ]
        ]

    ]
];


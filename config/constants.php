<?php

return [
//    used in HRM
    'gender' => [
        'male' => 'Male',
        'female' => 'Female',
        'both' => 'Both',
    ],
    'employee_available_status' => [
        'permanent' => 'Permanent',
        'contingency' => 'Contingency',
        'master roll' => 'Master Roll',
    ],
    'marital_status' => [
        'single' => 'Single',
        'married' => 'Married',
        'separated' => 'Separated',
        'divorced' => 'Divorced'
    ],
    'employee_education_medium' => [
        'bangla' => 'Bangla',
        'english' => 'English'
    ],
    'hrm_status' => [
        'qualified' => 'qualified',
        'short_listed' => 'short_listed',
        'submitted' => 'submitted'
    ],
    'hrm_employee_training' => [
        'region' => [
            'national' => 'National',
            'foreign' => 'Foreign'
        ],
        'nominating_authority' => [
            'bard' => 'BARD',
            'self' => 'SELF'
        ]
    ],
    'house_allocate' => [
        'status' => [
            'allocated' => 'allocated',
            'vacant' => 'vacant',
            'abandant' => 'abandant'
        ]
    ],
    'house_circular' => [
        'status' => [
            'active' => 'active',
            'inactive' => 'Inactive',
            'completed' => 'Completed'
        ]
    ],
//Use in PMS
    'project' => 'project',
    'research' => 'research',
//    USE IN PMS & RMS
    'research_proposal_feature_name' => 'Research Proposal',
    'project_proposal_feature_name' => 'Project Brief Proposal',
    'project_details_proposal_feature_name' => 'Project Details Proposal',
    //Employee Designations short code
    'faculty_member' => 'FM',
    'faculty_director' => 'DM',
    'research_director' => 'RD',
    'initiator' => 'initiator',
    'research_invite_submit' => ['DIRR'],
    'research_proposal_submission' => ['FD'],
    'research_proposal_send_back' => ['FD', 'initiator'],
    'research_proposal_approved' => ['initiator', 'DIRR', 'FD'],
    'research_short_listed' => ['initiator', 'DIRR', 'FD'],
    'research_approved_apc' => ['initiator', 'DIRR', 'FD'],
    // PMS: Keys with recipient list for notification
    'project_invite_submit' => ['PD', 'TaggedPerson'],
    'project_proposal_submission' => ['DRTR', 'TaggedPerson'],
    'project_proposal_review' => ['DRTR', 'initiator'],
    'project_proposal_send_back' => ['initiator'],
    'project_proposal_apc_approved' => ['initiator', 'DRTR', 'FD'],
    'project_share_jdp' => ['JD'],
    'project_share_adp' => ['AD'],
    'regex' => [
        'url' => '\b((http|https):\/\/?)[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/?))'
    ],
    'academic_levels' => [
        'secondary' => 'Secondary',
        'intermediate' => 'Intermediate',
        'undergraduate' => 'Undergraduate',
        'postgraduate' => 'Postgraduate'
    ],
    'academic_exams' => [
        'secondary' => [
            'J.S.C',
            'S.S.C',
            'Dakhil',
            'S.S.C Vocational',
            'O Level Cambridge',
            'S.S.C Equivalent'
        ],
        'intermediate' => [
            'H.S.C',
            'Alim',
            'Business Management',
            'Diploma in Engineering',
            'A Level/ Sr Cambridge',
            'H.S.C Equivalent'
        ],
        'undergraduate' => [
            'MBBS/BDS',
            'Honors',
            'Pass',
            'Fazil',
            'B.Sc (Engineering/Architecture)',
            'B.Sc (Agriculture Science)',
            'Bachelor Equivalent'
        ],
        'postgraduate' => [
            'MA',
            'MSS',
            'M.Sc',
            'M.Com',
            'MBA',
            'LLM',
            'MPA',
            'Masters Equivalent',
            'PHD',
            'M.Phil',
            'Others'
        ],
    ],
    // Keys for Salary Rule of Payroll in Accounts module
    'condition_types' => [1 => 'Always True', 2 => 'Range', 3 => 'Expression'],
    'amount_types' => [
        1 => 'Fixed Amount',
        2 => 'Percentage',
        3 => 'Random (Assign In Contract)'
    ],
    //'base_salary_rule_codes' =>['Basic', 'HRA', 'EA', 'GPFC'],
    'base_salary_rule_codes' => [''],
    'gpf_contribution_code' => 'GPFC',
    'gpf_advance_code' => 'GPFA',
    'bank_name' => 'Sonali Bank Ltd',
    'year_sum_digit' => [
        '1' => 6,
        '2' => 5,
        '3' => 4,
        '4' => 3,
        '5' => 2,
        '6' => 1,
        '7' => 12,
        '8' => 11,
        '9' => 10,
        '10' => 9,
        '11' => 8,
        '12' => 7,
    ],
    'gpf_status' => ['active', 'inactive', 'settled'],
    'pension_bonuses' => [
        'festival' => "Festival Bonus",
        'pohela_baishakh' => "Pohela Baishakh Bonus",
    ],
    // pension related constant's
    'pension' => [
        'rule' => [
            'type' => [
                'allowance' => 'Allowance',
                'bonus' => 'Bonus',
                'bonus_islamic' => 'Bonus Islamic',
                'bonus_other_religion' => 'Bonus Other Religion',
            ],
            'condition' => [
                'always_true' => 'Always True',
                'occasional' => 'Occasional',
            ],
            'amount_type' => [
                'fixed_amount' => 'Fixed',
                'percentage_amount' => 'Percentage',
            ],
        ],
        'contract' => [
            'disbursement_type' => [
                'bank' => 'Bank',
                'cash' => 'Cash',
            ],
            'disbursement_type_bn' => [
                'bank' => 'ব্যাঙ্ক',
                'cash' => 'নগদ'
            ],
            'receiver_type' => [
                'self' => 'Self',
                'nominee' => 'Nominee'
            ],
            'receiver_type_bangla' => [
                'self' => 'নিজ',
                'nominee' => 'নমিনী'
            ],

        ],
    ],
    // journal entry related constant's
    'journal_entry' => [
        'source' => [
            'local',
            'revenue'
        ],
        'account_transaction_type' => [
            'receipt',
            'payment'
        ],

        'payment_type' => [
            'bank',
            'cash'
        ],

        'statuses' => [
            'draft' => 'Draft',
            'approved' => 'Approved',
            'rejected' => 'Rejected'
        ],
        'dropdown' => [
            'source' => [
                'local' => 'Local',
                'revenue' => 'Revenue'
            ],
            'source_bn' => [
                'local' => 'স্থানীয়',
                'revenue' => 'রাজস্ব'
            ],
            'account_transaction_type' => [
                'receipt' => 'Receipt',
                'payment' => 'Payment'
            ],
            'account_transaction_type_bn' => [
                'receipt' => 'প্রাপ্তি',
                'payment' => 'প্রদান'
            ],
            'payment_type' => [
                'bank' => 'Bank',
                'cash' => 'Cash'
            ],
            'payment_type_bn' => [
                'bank' => 'ব্যাঙ্ক',
                'cash' => 'নগদ'
            ],
            'statuses' => [
                'draft' => 'Draft',
                'approved' => 'Approved',
                'rejected' => 'Rejected'
            ]
        ],
    ],
    'report_types' => [
        'expenditure' => 'expenditure',
        'receipt_payment' => 'receipt_payment',
    ],
    'economy_code_types' => [
        'temporary' => 'temporary',
        'receipt' => 'receipt',
    ],
    'payslip_statuses' => [
        'draft' => 'Draft',
        'approve' => 'Approve',
        'reject' => 'Reject'
    ],

    'facility_types' => [
        'hostel' => 'hostel',
        'cafeteria' => 'cafeteria',
        'auditorium' => 'auditorium',
        'classroom' => 'classroom'
    ],

    'booking_types' => [
        'general' => 'general',
        'training' => 'training',
        'venue' => 'venue',
        'physical_facility' => 'physical_facility'
    ],

    'room_booking_status' => [
        'pending' => 'pending',
        'verified' => 'verified',
        'approved' => 'approved',
        'rejected' => 'rejected'
    ],

    'accounts' => [
        'payslip' => [
            'payslip_types' => [
                'general',
                'bonus'
            ],
            'dropdown' => [
                'payslip_types' => [
                    'general' => 'General',
                    'festival_bonus' => 'Festival Bonus',
                    'boishakhi_bonus' => 'Boishakhi Bonus',
                ],
                'payslip_types_bn' => [
                    'general' => 'সাধারণ',
                    'festival_bonus' => 'উৎসব বোনাস',
                    'boishakhi_bonus' => 'বৈশাখী বোনাস',
                ]
            ],
            'bonus_codes' => [
                'all_bonus_codes' => [
                    'FB-1', // bonus for muslim
                    'FB-2', // bonus for other religion
                    'FB-3' // boishakhi bonus
                ],
                'festival_bonus_codes' => [
                    'FB-1', // bonus for muslim
                    'FB-2', // bonus for other religion
                ],
                'boishakhi_bonus_codes' => [
                    'FB-3' // boishakhi bonus
                ],
            ],

        ],

    ],
    // islam religion id, from the seeder
    'islam_religion_id' => 1,

    // TMS budget
    'tms_budget_sources' => [
        'revenue' => 'Revenue',
        'organization' => 'Organization'
    ],

    // TMS Accounts Report Types
    'tms_accounts_report_types' => [
        'budget' => 'budget',
        'expenditure' => 'expenditure',
    ],

    //Use in cafeteria module
    'cafeteria' => [
        'status' => [
            'added' => 'added',
            'deducted' => 'deducted',
            'draft' => 'draft',
            'pending' => 'pending',
            'approved' => 'approved',
            'rejected' => 'rejected',
            'active' => 'active',
            'inactive' => 'inactive',
            'purchased' => 'purchased',
            'initiated' => 'initiated',
            'deliver_material' => 'product-delivery',
            'paid' => 'paid',
            'due' => 'due',
            'unsold' => 'unsold'
        ],
        'unit_price' => [
            'regular' => 'regular',
            'subsidized_for_officers' => 'subsidized-officers',
            'subsidized_for_stafs' => 'subsidized-staffs',
        ],
        'reference_table' => [
            'purchase-lists' => 'purchase-lists',
            'finish-foods' => 'finish-foods',
            'sales' => 'sales',
            'food-orders' => 'food-orders',
            'initiated' => 'initiated',
            'deliver-materials' => 'deliver-materials',
            'unsold-foods' => 'unsold-foods'
        ],
        'roles' => [
            'cafeteria_manager' => 'ROLE_CAFETERIA_MANAGER',
            'cafeteria_user' => 'ROLE_CAFETERIA_USER'
        ],
        'purchase_report_type_en' => [
            'date-wise' => 'Date Wise',
            'product-wise' => 'Product Wise'
        ],
        'purchase_report_type_bn' => [
            'date-wise' => 'তারিখ অনুসারে ',
            'product-wise' => 'পণ্য অনুসারে'
        ],
        'sales_payment_types_en' => [
            'paid' => 'Paid',
            'due' => 'Due'
        ],
        'sales_payment_types_bn' => [
            'paid' => 'পরিশোধিত',
            'due' => 'বাকি'
        ],
        'sales_biller_types_en' => [
            'employee' => 'Employee',
            'training' => 'Training'
        ],
        'sales_biller_types_bn' => [
            'employee' => 'এমপ্লয়ি',
            'training' => 'প্রশিক্ষণ'
        ]
    ],

    'inventory_asset_types' => [
        'fixed asset' => 'fixed asset',
        'temporary asset' => 'temporary asset',
    ],

    'inventory_request_purposes' => [
        'official',
        'departmental'
    ],

    /*
     * Bootstrap classes for statuses. Add (only add) more if needed
     */
    'status_classes' => [
        'draft' => 'warning',
        'pending' => 'warning',
        'approved' => 'success',
        'approve' => 'success',
        'share' => 'success',
        'rejected' => 'danger',
        'reject' => 'danger',
        'active' => 'success',
        'inactive' => 'danger',
    ],

    // Bill types for Inventory
    'inventory_bill_types' => [
        'procurement' => 'procurement',
        'auction_sale' => 'auction_sale'
    ],

    // Asset evaluation type
    'asset_evaluation_types' => [
        'appreciation',
        'depreciation'
    ],

    // Recruitment exams
    'recruitment_exams' => ['preliminary', 'written', 'aptitude', 'viva'],

    // publication status
    'publication' => [
        'roles' => [
            'publication_committee' => 'ROLE_PUBLICATION_COMMITTEE',
            'publication_section_officer' => 'ROLE_PUBLICATION_SECTION_OFFICER'
        ]
    ]

];

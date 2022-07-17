<?php

return [
    'name' => 'VMS',
    'driver' => [
        'status' => [
            'active' => 'active',
            'inactive' => 'inactive'
        ]
    ],
    'vehicle' => [
        'status' => [
            'available' => 'available',
            'booked' => 'booked',
            'under_maintenance' => 'under_maintenance',
            'unavailable' => 'unavailable'
        ],
        'fuel_types' => [
            'gas' => 'gas',
            'oil' => 'oil'
        ]
    ],
    'trip' => [
        'workflow' => [
            'start_privilege' => [
                'ROLE_VMS_LINE_MANAGER',
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL'
            ],
            'flow' => [
                'ROLE_VMS_LINE_MANAGER' => 'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_ADMIN' => 'ROLE_DIRECTOR_GENERAL'
            ],
            'end_privilege' => [
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL'
            ],
            'reject_privilege' => [
                'ROLE_VMS_LINE_MANAGER',
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL'
            ],
            'super_admin' => 'ROLE_DIRECTOR_GENERAL',
            'vehicle_selection' => 'ROLE_VMS_LINE_MANAGER',
            'distance_restriction' => 50
        ],
        'status' => [
            'pending' => 'pending',
            'rejected' => 'rejected',
            'cancelled' => 'cancelled',
            'approved' => 'approved',
            'ongoing' => 'ongoing',
            'completed' => 'completed',
        ],
        'reason' => [
            'official' => 'official',
            'personal' => 'personal',
            'training' => 'training',
            'project' => 'project'
        ],
        'type' => [
            'official' => 'official',
            'personal' => 'personal',
            'training' => 'training',
            'project' => 'project'
        ],
        'distance' => [
            'below_25' => 'below_25',
            'above_25' => 'above_25'
        ],
        'payment_options' => [
            'payroll' => 'payroll',
            'accounts' => 'accounts',
            'tms_accounts' => 'tms_accounts',
            'project' => 'project',
        ],
        'payment_status' => [
            'pending' => 'pending',
            'paid' => 'paid',
            'partially_paid' => 'partially_paid',
        ],
        'setting' => [
            'status' => [
                'active' => 'active',
                'inactive' => 'inactive'
            ]
        ]
    ],
    'fuelBill' => [
        'workflow' => [
            'start_privilege' => [
                'ROLE_VMS_LINE_MANAGER',
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL'
            ],
            'flow' => [
                'ROLE_VMS_LINE_MANAGER' => 'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_ADMIN' => 'ROLE_DIRECTOR_GENERAL'
            ],
            'end_privilege' => [
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL'
            ],
            'super_admin' => 'ROLE_DIRECTOR_GENERAL',
            'distance_restriction' => 50
        ],
        'status' => [
            'pending' => 'pending',
            'rejected' => 'rejected',
            'cancelled' => 'cancelled',
            'approved' => 'approved',
            'ongoing' => 'ongoing',
            'completed' => 'completed',
        ],
        'reason' => [
            'official' => 'official',
            'personal' => 'personal',
            'training' => 'training',
            'project' => 'project'
        ],
        'distance' => [
            'below_25' => 'below_25',
            'above_25' => 'above_25'
        ],
        'setting' => [
            'status' => [
                'active' => 'active',
                'inactive' => 'inactive'
            ]
        ]
    ],
    'requisition' => [
        'workflow' => [
            'start_privilege' => [
                'ROLE_VMS_MECHANIC',
                'ROLE_VMS_LINE_MANAGER',
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL'
            ],
            'flow' => [
                'ROLE_VMS_MECHANIC' => 'ROLE_VMS_LINE_MANAGER',
                'ROLE_VMS_LINE_MANAGER' => 'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_ADMIN' => 'ROLE_DIRECTOR_GENERAL'
            ],
            'end_privilege' => [
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL'
            ],
            'super_admin' => 'ROLE_DIRECTOR_GENERAL',
            'amount_restriction' => 8000
        ],
        'status' => [
            'pending' => 'pending',
            'rejected' => 'rejected',
            'cancelled' => 'cancelled',
            'approved' => 'approved',
            'ongoing' => 'ongoing',
            'completed' => 'completed',
        ],
        'reason' => [
            'official' => 'official',
            'personal' => 'personal',
            'training' => 'training',
            'project' => 'project'
        ],
        'distance' => [
            'below_25' => 'below_25',
            'above_25' => 'above_25'
        ],
        'setting' => [
            'status' => [
                'active' => 'active',
                'inactive' => 'inactive'
            ]
        ]
    ]
];

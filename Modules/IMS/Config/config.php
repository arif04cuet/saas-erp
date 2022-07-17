<?php

return [
    'name' => 'IMS',
    'subTitle' => "Fixed Asset Management, Inventory & Warehouse",
    'constants' => [
        'item' => [
            'request' => [
                'purpose' => [
                    'training' => 'training',
//                    'hostel' => 'hostel',
//                    'project' => 'project',
//                    'research' => 'research',
                    'others' => 'others'
                ],
                'status' => [
                    'approved' => 'approved',
                    'draft' => 'draft',
                    'pending' => 'pending',
                    'new' => 'new',
                    'rejected' => 'rejected'
                ],
                'workflow' => [
                    'start_privilege' => [
                        'ROLE_DEPARTMENT_HEAD',
                        'ROLE_INVENTORY_STORE_ADMIN'
                    ],
                    'flow' => [
                        'ROLE_DEPARTMENT_HEAD' => 'ROLE_INVENTORY_STORE_ADMIN',
                    ],
                    'end_privilege' => [
                        'ROLE_DEPARTMENT_HEAD',
                        'ROLE_INVENTORY_STORE_ADMIN'
                    ],
                    'super_admin' => 'ROLE_INVENTORY_STORE_ADMIN',
                ],
            ]
        ],
    ],
];

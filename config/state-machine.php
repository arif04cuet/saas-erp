<?php

return [
    // inventory request
    'inventory_requests' => [
        // class of your domain object
        'class' => \Modules\IMS\Entities\InventoryRequest::class,

        // name of the graph (default is "default")
        'graph' => 'workflow',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        // list of all possible states
        'states' => [
            [
                'name' => 'new',
                'metadata' => [
                    'notification_type' => 'IMS_WORKFLOW',
                    'message' => 'Inventory Request is '
                ]
            ],
            [
                'name' => 'pending',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'roles' => [
                                    'ROLE_DEPARTMENT_HEAD'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW',
                    'message' => 'Inventory Request is ',
                ]
            ],
            [
                'name' => 'shared',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_APPROVE',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW',
                    'message' => 'Inventory Request is ',
                ]
            ],
            [
                'name' => 'approved',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id',
                                    'receiver_id'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'INVENTORY_REQUEST_RECEIVE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW',
                    'message' => 'Inventory Request is '
                ]
            ],
            [
                'name' => 'received',
                'metadata' => [
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW'
                ]
            ],
            [
                'name' => 'rejected',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id',
                                    'receiver_id'
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW',
                    'message' => 'Inventory Request is ',
                ]
            ]

        ],

        // list of all possible transitions
        'transitions' => [
            'pending' => [
                'from' => ['new'],
                'to' => 'pending',
                'metadata' => [
                    'next_state' => 'pending'
                ]
            ],
            'share' => [
                'from' => ['pending', 'shared'],
                'to' => 'shared',
                'metadata' => [
                    'next_state' => 'shared',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_SHARE'
                    ]
                ]
            ],
            'approve' => [
                'from' => ['shared'],
                'to' => 'approved',
                'metadata' => [
                    'next_state' => 'approved',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_APPROVE'
                    ]
                ]
            ],
            'receive' => [
                'from' => ['approved'],
                'to' => 'received',
                'metadata' => [
                    'next_state' => 'received',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_RECEIVE'
                    ]
                ]
            ],
            'reject' => [
                'from' => ['pending', 'shared'],
                'to' => 'rejected',
                'metadata' => [
                    'next_state' => 'rejected',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_REJECT'
                    ]
                ]
            ],
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [
                /*'guard_on_reviewing' => [
                    // call the callback on a specific transition
                    'on' => 'review',
                    // will call the method of this class
                    'do' => ['MyClass', 'handle'],
                    // arguments for the callback
                    'args' => ['object'],
                ],
                'guard_on_approving' => [
                    // call the callback on a specific transition
                    'on' => 'approve',
                    // will check the ability on the gate or the class policy
                    'can' => 'approve',
                ],*/
            ],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
//                'recipients' => [
//                    'do' => 'StateRecipientsManager@store'
//                ]
            ],
        ],

    ],

    // inventory item request workflow
    'inventory_item_requests' => [
        'class' => \Modules\IMS\Entities\InventoryItemRequest::class,

        // name of the graph (default is "default")
        'graph' => 'inventory-item-request-workflow',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        // list of all possible states
        'states' => [
            [
                'name' => 'new',
                'metadata' => [
                    'notification_type' => 'INVENTORY ITEM REQUEST',
                    'message' => 'Inventory Item Request is '
                ]
            ],
            [
                'name' => 'pending',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'roles' => [
                                    'ROLE_DEPARTMENT_HEAD'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-item-request.workflow.show',
                    'notification_type' => 'INVENTORY_ITEM_REQUEST',
                    'message' => 'Inventory Request is ',
                ]
            ],
            [
                'name' => 'approved',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id',
                                    'receiver_id'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'INVENTORY_REQUEST_RECEIVE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW',
                    'message' => 'Inventory Request is '
                ]
            ],
            [
                'name' => 'received',
                'metadata' => [
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW'
                ]
            ],
            [
                'name' => 'rejected',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            'after' => [
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show',
                    'notification_type' => 'IMS_WORKFLOW',
                    'message' => 'Inventory Request is ',
                ]
            ]

        ],

        // list of all possible transitions
        'transitions' => [
            'pending' => [
                'from' => ['new'],
                'to' => 'pending',
                'metadata' => [
                    'next_state' => 'pending'
                ]
            ],
            'approve' => [
                'from' => ['pending'],
                'to' => 'approved',
                'metadata' => [
                    'next_state' => 'approved',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_APPROVE'
                    ]
                ]
            ],
            'receive' => [
                'from' => ['approved'],
                'to' => 'received',
                'metadata' => [
                    'next_state' => 'received',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_RECEIVE'
                    ]
                ]
            ],
            'reject' => [
                'from' => ['pending', 'shared'],
                'to' => 'rejected',
                'metadata' => [
                    'next_state' => 'rejected',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_REJECT'
                    ]
                ]
            ],
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [
                /*'guard_on_reviewing' => [
                    // call the callback on a specific transition
                    'on' => 'review',
                    // will call the method of this class
                    'do' => ['MyClass', 'handle'],
                    // arguments for the callback
                    'args' => ['object'],
                ],
                'guard_on_approving' => [
                    // call the callback on a specific transition
                    'on' => 'approve',
                    // will check the ability on the gate or the class policy
                    'can' => 'approve',
                ],*/
            ],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
//                'recipients' => [
//                    'do' => 'StateRecipientsManager@store'
//                ]
            ],
        ],


    ],

    // auction request
    'auction' => [
        // class of your domain object
        'class' => \Modules\IMS\Entities\Auction::class,

        // name of the graph (default is "default")
        'graph' => 'auction-workflow',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        // list of all possible states
        'states' => [
            [
                'name' => 'new',
                'metadata' => [
                    'notification_type' => 'IMS_AUCTION_WORKFLOW',
                    'message' => 'Auction Request is ',
                ]
            ],
            [
                'name' => 'pending',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'roles' => [
                                    'ROLE_DEPARTMENT_HEAD'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'auction.workflow.show',
                    'notification_type' => 'IMS_AUCTION_WORKFLOW',
                    'message' => 'Auction Request is '
                ]
            ],
            [
                'name' => 'shared',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_APPROVE',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'auction.workflow.show',
                    'notification_type' => 'IMS_AUCTION_WORKFLOW',
                    'message' => 'Auction Request is '
                ]
            ],
            [
                'name' => 'approved',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id',
                                    'receiver_id'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'INVENTORY_REQUEST_RECEIVE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'auction.workflow.show',
                    'notification_type' => 'IMS_AUCTION_WORKFLOW',
                    'message' => 'Auction Request is '
                ]
            ],
            [
                'name' => 'received',
                'metadata' => [
                    'url' => 'auction.workflow.show',
                    'notification_type' => 'IMS_AUCTION_WORKFLOW'
                ]
            ],
            [
                'name' => 'rejected',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id',
                                    'receiver_id'
                                ]
                            ]
                        ]
                    ],
                    'url' => 'auction.workflow.show',
                    'notification_type' => 'IMS_AUCTION_WORKFLOW',
                    'message' => 'Auction Request is '
                ]
            ]

        ],

        // list of all possible transitions
        'transitions' => [
            'pending' => [
                'from' => ['new'],
                'to' => 'pending',
                'metadata' => [
                    'next_state' => 'pending'
                ]
            ],
            'share' => [
                'from' => ['pending', 'shared'],
                'to' => 'shared',
                'metadata' => [
                    'next_state' => 'shared',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_SHARE'
                    ]
                ]
            ],
            'approve' => [
                'from' => ['shared'],
                'to' => 'approved',
                'metadata' => [
                    'next_state' => 'approved',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_APPROVE'
                    ]
                ]
            ],
            'receive' => [
                'from' => ['approved'],
                'to' => 'received',
                'metadata' => [
                    'next_state' => 'received',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_RECEIVE'
                    ]
                ]
            ],
            'reject' => [
                'from' => ['pending', 'shared'],
                'to' => 'rejected',
                'metadata' => [
                    'next_state' => 'rejected',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_REJECT'
                    ]
                ]
            ],
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [
                /*'guard_on_reviewing' => [
                    // call the callback on a specific transition
                    'on' => 'review',
                    // will call the method of this class
                    'do' => ['MyClass', 'handle'],
                    // arguments for the callback
                    'args' => ['object'],
                ],
                'guard_on_approving' => [
                    // call the callback on a specific transition
                    'on' => 'approve',
                    // will check the ability on the gate or the class policy
                    'can' => 'approve',
                ],*/
            ],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
//                'recipients' => [
//                    'do' => 'StateRecipientsManager@store'
//                ]
            ],
        ],

    ],

    // leave request
    'leave_requests' => [
        // class of your domain object
        'class' => \Modules\HRM\Entities\LeaveRequest::class,

        // name of the graph (default is "default")
        'graph' => 'leave-request-workflow',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        // list of all possible states
        'states' => [
            [
                'name' => 'new',
                'metadata' => [
                    'notification_type' => 'HRM_LEAVE_REQUEST_WORKFLOW',
                    'message' => 'Employee Leave Request is '
                ]
            ],
            [
                'name' => 'pending',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'roles' => [
                                    'ROLE_DEPARTMENT_HEAD'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'hrm-leave-request.workflow.show',
                    'notification_type' => 'HRM_LEAVE_REQUEST_WORKFLOW',
                    'message' => 'Employee Leave Request is '
                ]
            ],
            [
                'name' => 'shared',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_APPROVE',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'hrm-leave-request.workflow.show',
                    'notification_type' => 'HRM_LEAVE_REQUEST_WORKFLOW',
                    'message' => "Employee Leave Request is "
                ]
            ],
            [
                'name' => 'approved',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'roles' => [
                                    'ROLE_HRM_SECTION_OFFICER'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_HRM_SECTION_OFFICER',
                                ]
                            ]
                        ]
                    ],
                    'url' => 'hrm-leave-request.workflow.show',
                    'notification_type' => 'HRM_LEAVE_REQUEST_WORKFLOW',
                    'message' => 'Employee Leave Request is '
                ]
            ],
            [
                'name' => 'rejected',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id',
                                    'receiver_id'
                                ]
                            ]
                        ]
                    ],
                    'url' => 'hrm-leave-request.workflow.show',
                    'notification_type' => 'HRM_LEAVE_REQUEST_WORKFLOW',
                    'message' => 'Employee Leave Request is '
                ]
            ]

        ],

        // list of all possible transitions
        'transitions' => [
            'pending' => [
                'from' => ['new'],
                'to' => 'pending',
                'metadata' => [
                    'next_state' => 'pending'
                ]
            ],
            'share' => [
                'from' => ['pending', 'shared'],
                'to' => 'shared',
                'metadata' => [
                    'next_state' => 'shared',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_SHARE'
                    ]
                ]
            ],
            'approve' => [
                'from' => ['shared'],
                'to' => 'approved',
                'metadata' => [
                    'next_state' => 'approved',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_APPROVE'
                    ]
                ]
            ],
            'receive' => [
                'from' => ['approved'],
                'to' => 'received',
                'metadata' => [
                    'next_state' => 'received',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_RECEIVE'
                    ]
                ]
            ],
            'reject' => [
                'from' => ['pending', 'shared'],
                'to' => 'rejected',
                'metadata' => [
                    'next_state' => 'rejected',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_REJECT'
                    ]
                ]
            ],
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [
                /*'guard_on_reviewing' => [
                    // call the callback on a specific transition
                    'on' => 'review',
                    // will call the method of this class
                    'do' => ['MyClass', 'handle'],
                    // arguments for the callback
                    'args' => ['object'],
                ],
                'guard_on_approving' => [
                    // call the callback on a specific transition
                    'on' => 'approve',
                    // will check the ability on the gate or the class policy
                    'can' => 'approve',
                ],*/
            ],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
//                'recipients' => [
//                    'do' => 'StateRecipientsManager@store'
//                ]
            ],
        ],

    ],

    // complaint invitation
    'complaint invitation' => [
        'class' => \Modules\HRM\Entities\ComplaintInvitation::class,

        'graph' => 'complaint_invitation',

        'property_path' => 'status',

        'states' => [
            'ready',
            'reviewing',
            'approved',
            'rejected',
        ],

        'transitions' => [
            'ready' => [
                'from' => ['reviewing'],
                'to' => 'ready'
            ],
            'review' => [
                'from' => ['ready'],
                'to' => 'reviewing'
            ],
            'approve' => [
                'from' => ['ready'],
                'to' => 'approved'
            ],
            'reject' => [
                'from' => ['ready'],
                'to' => 'rejected'
            ],
        ],

        'callbacks' => [
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
                'workflow' => [
                    'do' => 'ComplaintInvitationWorkflowManager@update',
                ],
            ]
        ]
    ],

    // Complaint
    'complaint' => [
        'class' => \Modules\HRM\Entities\Complaint::class,

        'graph' => 'complaint',

        'property_path' => 'status',

        'states' => [
            'new',
            'checking',
            'reviewing',
            'approved',
            'rejected',
        ],

        'transitions' => [
            'check' => [
                'from' => ['new'],
                'to' => 'checking'
            ],
            'review' => [
                'from' => ['new', 'checking', 'reviewing'],
                'to' => 'reviewing'
            ],
            'approve' => [
                'from' => ['reviewing'],
                'to' => 'approved'
            ],
            'reject' => [
                'from' => ['reviewing'],
                'to' => 'rejected'
            ],
        ],

        'callbacks' => [
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
                'workflow' => [
                    'do' => 'ComplaintWorkflowManager@update',
                ],
            ]
        ]
    ],

    'appraisal' => [
        'class' => \Modules\HRM\Entities\Appraisal::class,
        'graph' => 'appraisal',
        'property_path' => 'status',
        'states' => [
            [
                'name' => 'new',
                'metadata' => []
            ],
            [
                'name' => 'initialized',
                'metadata' => []
            ],
            [
                'name' => 'verified',
                'metadata' => []
            ],
            [
                'name' => 'reported',
                'metadata' => []
            ],
            [
                'name' => 'signed',
                'metadata' => []
            ],
            [
                'name' => 'completed',
                'metadata' => []
            ],
        ],
        'transitions' => [
            'initialize' => [
                'from' => ['new', 'verified'],
                'to' => 'initialized',
                'metadata' => []
            ],
            'verifying' => [
                'from' => ['initialized'],
                'to' => 'verified',
                'metadata' => []
            ],
            'reporting' => [
                'from' => ['new', 'initialized'],
                'to' => 'reported',
                'metadata' => []
            ],
            'signing' => [
                'from' => ['reported'],
                'to' => 'signed',
                'metadata' => []
            ],
            'completing' => [
                'from' => ['signed'],
                'to' => 'completed',
                'metadata' => []
            ],
        ],
        'callbacks' => [
            'guard' => [],
            'before' => [],
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
                'workflow' => [
                    'do' => 'AppraisalWorkflowManager@update'
                ],
            ]
        ]
    ]
];

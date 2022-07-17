<?php

return [
    'transitions' => [
        'release' => [
            'title' => 'Release'
        ],
        'reject' => [
            'title' => 'Reject'
        ],
        'share' => [
            'title' => 'Share'
        ],
        'approve' => [
            'title' => 'Approve'
        ],
        'receive' => [
            'title' => 'Receive'
        ],
    ],
    'event' => [
        'messages' => [
            'success' => 'Request has been submitted successfully.',
            'error' => 'Sorry, please try again.'
        ]
    ],
    'validations' => [
        'available' => 'Requested amount of items are available.',
        'not_available' => 'Requested amount of items are not available.'
    ],
    'request' => [
        'details' => [
            'table' => [
                'columns' => [
                    'available' => 'Available'
                ]
            ]
        ]
    ]
];
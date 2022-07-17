<?php

return [
    'transitions' => [
        'release' => [
            'title' => 'খালাস'
        ],
        'reject' => [
            'title' => 'প্রত্যাখ্যান'
        ],
        'share' => [
            'title' => 'শেয়ার'
        ],
        'approve' => [
            'title' => 'অনুমোদন'
        ],
        'receive' => [
            'title' => 'গ্রহণ'
        ]
    ],
    'event' => [
        'messages' => [
            'success' => 'আপনার অনুরোধটি সফলভাবে সংরক্ষন করা হয়েছে।',
            'error' => 'দুঃখিত, আবার চেষ্টা করুন।'
        ]
    ],
    'validations' => [
        'available' => 'অনুরোধকৃত পরিমাণ আইটেম আয়ত্তাধীন আছে।',
        'not_available' => 'অনুরোধকৃত পরিমাণ আইটেম আয়ত্তাধীন নেই।'
    ],
    'request' => [
        'details' => [
            'table' => [
                'columns' => [
                    'available' => 'আয়ত্তাধীন'
                ]
            ]
        ]
    ]
];
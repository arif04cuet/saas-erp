<?php

return [
    'title' => 'শিরোনাম',
    'start_date' => 'শুরুর তারিখ',
    'end_date' => 'শেষের তারিখ',
    'no_of_trainees' => 'প্রশিক্ষণার্থীর সংখ্যা',
    'hostel' => 'হোস্টেল',
    'batch' => 'ব্যাচ',
    'validations' => [
        'fields' => [
            'no_of_trainees' => [
                'min' => ':attribute এর সমান অথবা বড় হতে হবে ।',
                'max' => ':attribute এর সমান অথবা ছোট হতে হবে ।',
            ],
        ],
    ],
];

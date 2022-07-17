<?php

return [
    'speaker_email' => [
        'duration' => [
            'start' => env('SPEAKER_EMAIL_DURATION_START', '19:00'),
            'end' => env('SPEAKER_EMAIL_DURATION_END', '23:59'),
        ],
    ],
    'trainee_email' => [
        'duration' => [
            'start' => env('TRAINEE_EMAIL_DURATION_START', '21:00'),
            'end' => env('TRAINEE_EMAIL_DURATION_END', '23:59'),
        ],
    ],
    'course_administration_email' => [
        'duration' => [
            'start' => env('COURSE_ADMIN_EMAIL_DURATION_START', '20:00'),
            'end' => env('COURSE_EMAIL_DURATION_END', '23:59'),
        ],
    ],
    'trainee_evaluation_warning' => [
        'fetch_recipients' => [
            'hourly_at' => env('TRAINEE_EVALUATION_WARNING_FETCH_RECIPIENTS_HOURLY_AT', 1),
            'hour_before_expire' => env('TRAINEE_EVALUATION_WARNING_HOUR_BEFORE_EXPIRE  ', 2),
        ],
    ],
    'trainee_list' => [
        'did_not_evaluated' => [
            'daily_at' => env('TRAINEE_LIST_DID_NOT_EVALUATED_DAILY_AT', '00:05'),
        ],
    ],
];

<?php

return [
    'link_title' => 'Update session schedule for :attribute',
    'message' => [
        'submit' => [
            'wait' => 'Please Wait',
            'success' => 'Item has been saved successfully.',
            'error' => "Couldn't update, please try again.",
        ],
    ],
    'session' => [
        'title' => 'Scheduled Sessions',
    ],
    'fields' => [
        'date' => 'Date',
        'end' => 'End',
        'start' => 'Start',
    ],
    'notification' => [
        'title' => ':attribute Notified',
        'status' => [
            'yes' => '',
            'no' => 'Not',
        ],
    ],
    'email' => [
        'title' => 'Scheduled Sessions',
        'description' => 'Your session\'s schedule for tomorrow is given below.',
    ],
    'evaluation' => [
        'text' => 'Please click :attribute to evaluate speakers',
        'link' => '<a style="color: blue;" href="' . route('trainings.public.index') . '">here</a>'
    ],
    'warning' => [
        'title' => '',
        'description' => 'A few hours left to evaluate the following sessions',
    ],
    'evaluate' => [
        'button' => [
            'title' => 'Evaluate',
        ],
        'last_time' => 'Expiry Time of Evaluation',
    ],
    'select_start_time' => 'Select start time',

];

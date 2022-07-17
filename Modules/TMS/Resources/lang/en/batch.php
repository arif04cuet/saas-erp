<?php

return [
    'title' => 'Title',
    'start_date' => 'Start Date',
    'end_date' => 'End Date',
    'no_of_trainees' => 'No. of Trainees',
    'hostel' => 'Hostel',
    'batch' => 'Batch',
    'validations' => [
        'fields' => [
            'no_of_trainees' => [
                'min' => 'Must be greater than or equal to :attribute.',
                'max' => 'Must be less than or equal to :attribute.'
            ],
        ],
    ],
];

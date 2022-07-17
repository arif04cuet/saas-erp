<?php

return [
    'name_locale' => 'english_name',
    'help_number' => 'For any technical assistance call +880 1712-226683',
    'registration' => [
        'mobile' => [
            'unique' => 'Registration with this number has already been completed'
        ],
        'validations' => [
            'mobile' => '[0-9]',
            'experience' => '[0-9\u002E]',
        ],
    ],
    'personal_info' => 'Personal Information',
    'edit_trainee' => 'Edit Trainee',
    'add_trainee' => 'Add Trainee',
    'bengali_certificate' => 'Bengali Certificate',
    'certificate' => 'Certificate',
    'english_certificate' => 'English Certificate',
    'fields' => [
        'image' => [
            'maximum' => 'Maximum',
            'size' => 'Size',
            '3mb' => '3 MB',
        ],
    ],
    'title' => 'Trainees',
    'did_not_evaluated' => 'Didn\'t Evaluated',
    'email' => [
        'title' => '',
        'description' => 'List of trainees are given below who didn\'t evaluated the above session.',
    ],
    'errors' => [
        'messages' => [
            'regex' => [
                'bn' => 'Only bengali letters are valid',
                'en' => 'Only english letters are valid',
                'number' => 'Only english number are valid',
            ],
            'image_size' => 'Uploaded image is greater than 3 mb',
            'experience' => 'Please enter a valid number (in between 0 to 50)',
        ],
    ],
    'designation' => 'Designation',
    'import' => [
        'title' => 'Trainee Import',
        'error_messages' => [
            'name_error' => 'Please Provide A Proper Name',
            'duplicate_error' => 'This :value Is Previously Used !',
            'email_error' => 'This Email Address Is Previously Used!',
            'gender_error' => 'Please Provide A Correct Gender (Male/Female/Others)',
            'dob_error' => 'Please Provide Date Of Birth In Y-m-d format',
        ]
    ],
    'language_preference' => [
        'both' => 'English & Bangla',
        'only_english' => 'Only English',
        'only_bangla' => 'Only Bangla'
    ]
];

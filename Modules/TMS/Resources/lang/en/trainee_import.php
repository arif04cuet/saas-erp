<?php
return [
    'title' => 'Trainee Import',
    'form_elements' => [
        'bangla_name' => 'Bangla Name',
        'english_name' => 'English Name',
        'name' => 'Name',
        'gender' => 'Gender',
        'mobile_number' => 'Mobile Number',
        'email' => 'Email',
        'dob' => 'dob',
        'father_name' => 'Father Name',
        'father_name_bangla' => 'Father Name (Bangla)',
        'mother_name' => 'Mother Name',
        'mother_name_bangla' => 'Mother Name (Bangla)',
        'address' => 'Address',
        'address_bangla' => 'Address (Bangla)',
    ],
    'error_messages' => [
        'no_data_error' => 'No data provided !',
        'name_error' => 'Please Provide A Proper Name',
        'duplicate_error' => 'This :value Is Previously Used !',
        'email_error' => 'This Email Address Is Previously Used!',
        'mobile_format_error' => 'Please Provide A Valid Number!',
        'gender_error' => 'Please Provide A Correct Gender (Male/Female/Others)',
        'dob_error' => 'Please Provide Date Of Birth In Y-m-d format',
    ]
];

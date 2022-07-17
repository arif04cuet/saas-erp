<?php
return [
    'validations' => [
        'required' => 'attachment is required.',
        'mimes' => 'attachment must be a file type of ',
        'max' => 'attachment may not be greater than :value kilobytes.'
    ],
    'title' => 'Add attachment',
    'buttons' => [
        'upload' => [
            'title' => 'Upload'
        ]
    ]
];
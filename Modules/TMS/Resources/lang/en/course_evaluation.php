<?php

return [
    'title' => 'Course Evaluation',
    'add' => 'Add New Course Evalution',
    'settings' => [
        'title' => 'Course Evaluation Settings',
        'status' => [
            'enabled' => 'Evaluation for this course is enabled',
            'disabled' => 'Evaluation for this course is disabled',
        ],
        'buttons' => [
            'enable' => 'Enable',
            'disable' => 'Disable',
        ],
        'form' => [
            'edit' => [
                'labels' => [
                    'status' => 'Enable Evaluation for this Course',
                    'start_date' => 'Start Date',
                    'end_date' => 'End Date',
                ],
                'fields' => [
                    'status' => 'Enable',
                    'start_date' => 'Start Date',
                    'end_date' => 'Start Date',
                ],
            ],
        ],
        'errors' => [
            'fields' => [
                'start_date' => [
                    'after_or_equal' => 'Please select a date equal or after this :attribute date',
                ],
                'end_date' => [
                    'after_or_equal' => 'Please select a date equal or after this :attribute date',
                ],
            ],
        ],
    ],
    'defaults' => [
        'organization' => [
            'title' => 'Bangladesh Academy for Rural Development (BARD) Kotbari, Comilla',
        ],
        'description' => "Thank you for attending the <b>:attribute</b>. Your feedback as a participant is crucial for BARD to ensure that we are meeting your training needs. Your feedback also allows us to continually adapt training to better suit needs of the future trainees. We would appreciate if you could take a few minutes filling in this evaluation form. Your feedback will be treated in the strictest of confidence",
    ],
    'introduction' => 'Introduction',
    'section' => 'Section',
    'question' => 'Question',
    'answer' => 'Answer',
    'mark' => 'Mark',
    'course_empty_lists' => "<b>No Course has been found to Evaluate.</b>",
    'course_empty_message' => 'No one evaluated this course yet',
];

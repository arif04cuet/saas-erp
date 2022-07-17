<?php

return [
    'title' => 'Lesson',
    'lession_heading' => 'Lession Heading',
    'sessions' => 'Training Syllabus',
    'expire_time' => "Evaluation Expiry Duration(in hour) <br> default(24 hours) ",
    'length' => 'Lesson Length (Hour)',
    'speaker' => 'Speaker',
    'select_batch' => 'Select Batch to Create Lesson Schedule',
    'preview' => 'Show Preview',
    'preview_title' => 'Lesson Schedule Preview',
    'preview_warning' => 'Can not remove while on preview mode!',
    'not_found' => 'No session found!',
    'notify_trainee' => 'Send Schedules To Trainee',
    'flash_messages' => [
        'notify_trainee' => [
            'start' => 'An email will be sent to trainees including scheduled sessions for tomorrow',
            'error' => trans('labels.generic_error_message'),
        ]
    ]
];

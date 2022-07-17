<?php

return [
    'title' => 'বার্ষিক প্রশিক্ষণ বিজ্ঞপ্তি',
    'menu_title' => 'বার্ষিক প্রশিক্ষণ বিজ্ঞপ্তি',
    'create_notification' => 'বার্ষিক প্রশিক্ষণ বিজ্ঞপ্তি তৈরি',
    'organization' => 'সংগঠন',
    'attachment' => 'সংযুক্তি',
    'note' => 'টীকা',
    'list' => 'বার্ষিক প্রশিক্ষণ বিজ্ঞপ্তি তালিকা',
    'email' => 'ই-মেইল',
    'email_body' => 'ই-মেইল বৃত্তান্ত',
    'organization_name' => 'সংগঠনের নাম',
    'notified_date' => 'অবহিত সময়',
    'responded_time' => 'প্রতিক্রিয়া সময়',
    'add_response' => 'প্রতিক্রিয়া যোগ করুন',
    'view_response' => 'প্রতিক্রিয়া দেখুন',
    'create_button' => 'নতুন বিজ্ঞপ্তি',
    'year' => 'বছর',
    'send_dd' => 'বিভাগীয় পরিচালকগন অন্তর্ভুক্ত',
    'dds' => 'বিভাগীয় পরিচালকগন',
    'dd_name' => 'বিভাগীয় পরিচালক',
    'department' => 'ডিপার্টমেন্ট',
    'preview_button' => 'ই-মেইল প্রিভিউ ',
    'preview' => 'প্রশিক্ষণ বিজ্ঞপ্তি ই-মেইল প্রিভিউ',
    'confirmation' => 'বিজ্ঞপ্তিতে উল্লেখিতদের নিকট বিজ্ঞপ্তিটি ইমেইল আকারে পাঠানো হবে। আপনি কি নিশ্চিত?',
    'email_content' => [
        'initials' => ' Please follow the link here :url to give your response or send email
            with the format mentioned in the following letter.',
        'subject' => 'Subject: Training Demand for Next Financial Year',
        'body' => 'Bangladesh Academy for Rural Development (BARD) is going to organize its Annual Planning
            Conference for evaluating its performance of previous year and formulating its plan for next years. In this
            connection it will be highly appreciated if you kindly let us know your plan to organise training course at
            BARD during July :start to June :end by filling the following format. You are also requested to send your
            demand by <strong>:date</strong>',
        'footer' => 'Thanking you in anticipation.',

    ],
    'response' => [
        'title' => 'বার্ষিক প্রশিক্ষণ বিজ্ঞপ্তি প্রতিক্রিয়া',
        'menu_title' => 'বার্ষিক প্রশিক্ষণ বিজ্ঞপ্তি প্রতিক্রিয়া',
        'index' => 'বার্ষিক প্রশিক্ষণ বিজ্ঞপ্তি প্রতিক্রিয়া তালিকা',
        'expired_message' => 'দুঃখিত! জমা দেওয়ার তারিখ শেষ হয়ে গেছে',
        'form_elements' => [
            'title' => trans('labels.title'),
            'repeater_title' => 'প্রশিক্ষণ তথ্য',
            'organization' => 'সংগঠন',
            'no_of_trainee' => 'অংশগ্রহণকারীদের সংখ্যা',
            'participant_type' => 'অংশগ্রহণকারী প্রকার',
            'start_date' => 'শুরুর তারিখ',
            'end_date' => 'শেষ তারিখ',
            'remark' => trans('labels.remarks'),
            'status' => trans('labels.status'),
        ]
    ],
    'file' => 'ফাইল',
];

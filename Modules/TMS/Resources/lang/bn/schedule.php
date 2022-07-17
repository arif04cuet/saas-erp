<?php

return [
    'link_title' => ':attribute এর লেসন শিডিউল হালনাগাদ করুন',
    'message' => [
        'submit' => [
            'wait' => 'অপেক্ষা করুন',
            'success' => 'আইটেম সফলভাবে সংরক্ষণ করা হয়েছে।',
            'error' => 'আইটেম সংরক্ষণ করা সম্ভব হয়নি, অনুগ্রহপূর্বক আবার চেষ্টা করুন।'
        ],
    ],
    'session' => [
        'title' => 'পরিকল্পিত ট্রেনিং সিলেবাস',
    ],
    'fields' => [
        'date' => 'তারিখ',
        'end' => 'সমাপ্তির সময়',
        'start' => 'শুরুর সময়',
    ],
    'notification' => [
        'title' => 'অবহিত :attribute',
        'status' => [
            'yes' => 'করা হয়েছে',
            'no' => 'করা হয় নাই',
        ],
    ],
    'email' => [
        'title' => 'পরিকল্পিত লেসন সমূহ',
        'description' => 'আপনার আগামীকালের লেসন সূচী নিন্মে দেওয়া হল।',
    ],
    'evaluation' => [
        'text' => 'স্পিকার মূল্যায়ন করতে :attribute ক্লিক করুন',
        'link' => '<a style="color: blue;" href="' . route('trainings.public.index') . '">এখানে</a>',
    ],
    'warning' => [
        'title' => '',
        'description' => 'নিম্মোক্ত সেশনসমূহ মূল্যায়ন করার জন্য অল্প কিছু সময় বাকী আছে ।',
    ],
    'evaluate' => [
        'button' => [
            'title' => 'মূল্যায়ন করুন',
        ],
        'last_time' => 'মূল্যায়নের শেষ সময়',
    ],
    'select_start_time' => 'শুরুর সময় নির্বাচন করুন'
];

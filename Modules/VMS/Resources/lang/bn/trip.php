<?php

return [
    'title' => 'যাত্রা',
    'create' => 'যাত্রা তৈরী করুন ',
    'index' => 'যাত্রা তালিকা',
    'menu_title' => 'যাত্রা',
    'details' => 'যাত্রা বিস্তারিত',
    'allocated' => 'বরাদ্দ করুন',
    'previous_trip_title' => 'পুর্ববর্তী  যাত্রা (সাম্প্রতিক মাস)',
    'apply' => [
        'menu_title' => 'আবেদন করুন',
        'index' => '',
        'form_elements' => [
        ]
    ],
    'type' => [
        'title' => 'নমুনা',
        'official' => 'দাপ্তরিক',
        'personal' => 'ব্যক্তিগত',
        'training' => 'ট্রেনিং',
        'project' => 'প্রোজেক্ট'
    ],
    'distance' => [
        'below_25' => '২৫ কিলোমিটারের নীচে',
        'above_25' => '২৫ কিলোমিটারের বেশি'
    ],
    'form_elements' => [
        'requester_id' => 'অনুরোধকারী',
        'billed_to' => 'বিল',
        'type' => 'নমুনা',
        'start_date_time' => 'যাত্রার তারিখ এবং সময়',
        'end_date_time' => 'যাত্রা ফেরতের তারিখ এবং সময়',
        'no_of_passenger' => 'যাত্রীর সংখ্যা',
        'passengers' => 'যাত্রী',
        'is_requester_passenger' => 'আমাকে যাত্রী হিসাবে অন্তর্ভুক্ত করুন',
        'destination' => 'গন্তব্য',
        'distance' => 'দূরত্ব (কিঃমিঃ)',
        'reason' => 'যাত্রার কারণ',
        'length' => 'যাত্রার সময়কাল'
    ],
    'status' => [
        'all' => 'সকল',
        'pending' => 'পেন্ডিং',
        'rejected' => 'প্রত্যাখ্যাত',
        'cancelled' => 'বাতিল',
        'approved' => 'অনুমোদিত',
        'ongoing' => 'চলমান',
        'completed' => 'সমাপ্ত',
    ],
    'notification_messages' => [
        'start' => ':name একটি যাত্রা অনুরোধ করেছেন ।',
        'approved' => 'আপনার যাত্রা অনুরোধ অনুমোদন করা হয়েছে ।',
        'rejected' => 'আপনার যাত্রা অনুরোধ বাতিল করা হয়েছে ।',
        'begin' => 'আপনার যাত্রা আরম্ভ হয়েছে। শুভ যাত্রা !',
        'completed' => 'আপনার যাত্রা সম্পন্ন করা হয়েছে ।',
        'cancelled' => 'আপনার যাত্রা অনুরোধ বাতিল করা হয়েছে ।',
        'ongoing' => 'আপনার যাত্রা আরম্ভ হয়েছে। শুভ যাত্রা!',
        'pending' => 'আপনার যাত্রা অনুরোধ অনুমোদন করা হয়েছে ।তালিকা থেকে যাত্রা শুরু করুন',
        'update_trip_message' => 'আপনার ট্রিপ সময়কাল সুপারভাইজার পরিবর্তন করেছেন ।',
        'workflow_message' => 'ধন্যবাদ ।অনুরোধটি :name কে পাঠানো হয়েছে'
    ],
    'feedback' => [
        'title' => 'প্রতিক্রিয়া',
        'create' => 'প্রতিক্রিয়া তৈরি করুন',
        'form_elements' => [
            'actual_start_date_time' => 'যাত্রার তারিখ এবং সময়',
            'actual_end_date_time' => 'যাত্রা ফেরতের তারিখ এবং সময়',
            'completed_distance' => 'সম্পন্ন দূরত্ব(কিঃ মিঃ)',
            'trip_length_hour' => 'মোট যাত্রা সময়কাল (ঘন্টা)',
        ]
    ],
    'setting' => [
        'title' => 'যাত্রা হিসাব সেটিংস',
        'menu_title' => 'হিসাব সেটিংস',
        'exceed_title' => 'যাত্রা অতিক্রম হিসাব সেটিংস',
        'create' => 'হিসাব সেটিংস তৈরি করুন',
        'form_elements' => [
            'per_km_taka' => 'প্রতি কিঃ মিঃ টাকা',
            'per_hour_taka' => 'প্রতি ঘন্টা টাকা',
            'oil_price' => 'তেলের দাম',
            'gas_price' => 'গ্যাসের দাম',
            'is_exceed_setting' => 'অতিক্রম হিসাব সেটিংস',
        ]
    ],
    'bill' => [
        'title' => 'যাত্রা বিল',
        'menu_title' => 'যাত্রা বিল',
        'show' => 'বিল ',
        'details' => 'বিল বিস্তারিত',
        'calculation' => 'হিসাব',
        'payment_title' => 'পেমেন্ট অপশন',
        'monthly_bill' => 'মাসিক বিল (ব্যক্তিগত)',
        'payment_option' => [
            'payroll' => 'বিল পে-রোল যুক্ত করুন',
            'accounts' => 'বিল পরিশোধ হয়েছে',
            'tms_accounts' => 'প্রশিক্ষণ বিভাগে প্রেরণ করুন',
            'project' => 'প্রকল্প বিভাগে প্রেরণ করুন',
        ],
        'payment_status' => [
            'pending' => trans('labels.pending'),
            'paid' => 'পরিশোধিত',
            'partially_paid' => 'আংশিকভাবে পরিশোধিত',
        ],
        'labels' => [
            'add_to_payroll' => 'বিল পে-রোল যুক্ত করুন',
            'mark_as_paid' => 'বিল পরিশোধ হয়েছে',
            'pay_to_training' => 'প্রশিক্ষণ বিভাগে প্রেরণ করুন',
            'pay_to_project' => 'প্রকল্প বিভাগে প্রেরণ করুন',
            'payment' => 'পেমেন্ট অবস্থা'
        ],
        'flash_messages' => [
            'payment_error' => 'পেমেন্ট ব্যর্থ হয়েছে',
            'payment_success' => 'পেমেন্ট সফল হয়েছে',
            'show_official_error' => 'অফিসিয়াল ট্রিপে বিলিংয়ের প্রয়োজন হয় না'
        ],
        'submission' => [
            'title' => 'মাসিক বিল জমা দিন',
            'trip_bill' => 'ট্রিপ বিল (বকেয়া)',
            'sector_bill' => 'মাসিক বিল (বকেয়া)'
        ]
    ],
    'limit' => [
        'title' => 'যাত্রা সীমা',
        'create' => ' যাত্রা সীমা তৈরি করুন',
        'edit' => ' যাত্রা সীমা সম্পাদন করুন',
        'index' => ' যাত্রা সীমা তালিকা',
        'crossed_limits' => 'যাত্রা সীমা অতিক্রম করেছে ?',
        '1' => 'হ্যা',
        '0' => 'না',
        'form_elements' => [
            'designation_id' => 'পদবি',
            'limit' => 'সর্বাধিক সীমা'
        ],
        'flash_messages' => [
            'trip_limit_crossed' => 'অনুরোধকারী এই মাসে সর্বাধিক ট্রিপ সীমা অতিক্রম করেছে!'
        ]
    ],
    'flash_messages' => [
        'vehicle_selection_error' => 'অন্তত একটি গাড়ি নির্বাচন করুন',
        'vehicle_already_allocated_time_error' => 'দুঃখিত ! এই গাড়িটি :start সময় থেকে :end পর্যন্ত বুক করা আছে!'
    ]
];

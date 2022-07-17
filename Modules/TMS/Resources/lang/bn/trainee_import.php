<?php
return [
    'title' => 'প্রশিক্ষণার্থী ইম্পোর্ট',
    'form_elements' => [
        'bangla_name' => 'বাংলা নাম',
        'english_name' => 'ইংরেজী নাম',
        'name' => 'নাম',
        'gender' => 'লিঙ্গ',
        'mobile_number' => 'মোবাইল নম্বর',
        'email' => 'ইমেইল',
        'dob' => 'জন্ম তারিখ',
        'father_name' => 'বাবার নাম',
        'father_name_bangla' => 'বাবার নাম (বাংলা)',
        'mother_name' => 'মায়ের নাম',
        'mother_name_bangla' => 'মায়ের নাম (বাংলা)',
        'address' => 'ঠিকানা',
        'address_bangla' => 'ঠিকানা (বাংলা)',
    ],
    'error_messages' => [
        'no_data_error' => 'কোনও ডেটা পাওয়া যায় নি !',
        'name_error' => 'দয়া করে একটি সঠিক নাম দিন',
        'duplicate_error' => 'এই :value আগে ব্যবহৃত হয়েছে!',
        'email_error' => 'এই ইমেইল আগে ব্যবহৃত হয়েছে!',
        'mobile_format_error' => 'দয়া করে একটি বৈধ নম্বর দিন',
        'gender_error' => 'দয়া করে একটি সঠিক লিঙ্গ দিন (male/female/others)',
        'dob_error' => 'অনুগ্রহ করে Y-m-d ফর্ম্যাটে জন্ম তারিখ দিন',
    ]
];

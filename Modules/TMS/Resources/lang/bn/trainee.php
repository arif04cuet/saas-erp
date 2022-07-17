<?php


return [
    'name_locale' => 'bangla_name',
    'help_number' => 'প্রযুক্তিগত সহায়তার জন্য +880 1712-226683 এই নম্বরে কল করুন',
    'registration' => [
        'mobile' => [
            'unique' => 'এই নম্বর দিয়ে ইতিমধ্যে রেজিস্ট্রেশন সম্পন্ন হয়েছে'
        ],
        'validations' => [
            'mobile' => '[\u09E6-\u09EF]',
            'experience' => '[\u09E6-\u09EF\u002E]',
        ],
    ],
    'personal_info' => 'ব্যাক্তিগত তথ্য',
    'edit_trainee' => 'প্রশিক্ষণার্থী সম্পাদনা',
    'add_trainee' => 'প্রশিক্ষণার্থী যোগ করুন',
    'bengali_certificate' => 'বাংলা সনদপত্র',
    'certificate' => 'সনদপত্র',
    'english_certificate' => 'ইংরেজি সনদপত্র',
    'fields' => [
        'image' => [
            'maximum' => 'সর্বাধিক',
            'size' => 'সাইজ',
            '3mb' => '৩ মেগাবাইট',
        ],
    ],
    'title' => 'প্রশিক্ষণার্থী',
    'did_not_evaluated' => 'মূল্যায়ন করেনি',
    'email' => [
        'title' => '',
        'description' => 'উপরোক্ত সেশনের জন্য যে সকল প্রশিক্ষণার্থী মূল্যায়ন করেনি তাদের তালিকা নিম্মে দেওয়া হল ।',
    ],
    'errors' => [
        'messages' => [
            'regex' => [
                'bn' => 'শুধুমাত্র বাংলা অক্ষর প্রযোজ্য',
                'en' => 'শুধুমাত্র ইংরেজী অক্ষর প্রযোজ্য',
                'number' => 'শুধুমাত্র বাংলা নম্বর প্রযোজ্য'
            ],
            'image_size' => 'আপলোডকৃত ছবিটি ৩ মেগাবাইট থেকে বড়',
            'experience' => 'দয়া করে একটি বৈধ সংখ্যা লিখুন (০ থেকে ৫০ এর ভিতর)',
        ],
    ],
    'designation' => 'উপাধি',
    'language_preference' => [
        'both' => 'ইংরেজি ও বাংলা',
        'only_english' => 'শুধুমাত্র ইংরেজি',
        'only_bangla' => 'শুধুমাত্র বাংলা'
    ]
];

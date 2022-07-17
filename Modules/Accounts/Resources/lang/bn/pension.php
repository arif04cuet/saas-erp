<?php
return [
    'create' => 'পেনশন তৈরি করুন',
    'title' => 'পেনশন',
    'index' => 'পেনশন তালিকা',

    'lump_sum' => [
        'create' => 'আনুতোষিক পরিশোধ তৈরি করুন',
        'title' => 'আনুতোষিক পরিশোধ',
        'index' => 'আনুতোষিক পরিশোধ তালিকা',
        'form' => 'আনুতোষিক পরিশোধ ফর্ম',
        'bill' => 'আনুতোষিক বিল ডাউনলোড',
        'form_elements' => [
            'employee' => 'কর্মচারী/কর্মকর্তা',
            'basic_salary' => 'মূল বেতন',
            'eligible_pension' => 'পেনশনের জন্য যোগ্য',
            'monthly_pension' => 'মাসিক পেনশন',
            'total_lump_sum' => 'মোট আনুতোষিক পরিশোধ',
            'lump_sum' => 'আনুতোষিক পরিশোধ',
            'status' => 'অবস্থা',
            'disbursed' => 'বিতরণ করা হয়েছে',
            'receiver' => 'গ্রাহক'
        ],
        'mark_as_disbursed' => 'বিতরণ করুন',
        'status' => [
            'draft' => 'খসড়া',
            'disbursed' => 'বিতরণ করা হয়েছে',
        ],
        'deduction' => [
            'title' => 'কর্তন',
            'form_elements' => [
                'title' => 'পদবি',
                'code' => 'কোড',
                'amount' => 'অর্থের পরিমাণ',
                'remark' => 'মন্তব্য',
            ],
        ]
    ],
    'deduction' => [
        'title' => 'পেনশন কর্তন',
        'create' => 'পেনশন কর্তন তৈরি করুন',
        'index' => 'পেনশন কর্তন তালিকা',
        'form' => 'পেনশন কর্তন ফর্ম',
        'form_elements' => [
            'name' => 'নাম',
            'bangla_name' => 'বাংলা নাম',
            'description' => 'বিবরণ',
        ],
    ],
    'monthly' => [
        'create' => 'মাসিক পেনশন তৈরি',
        'title' => 'মাসিক পেনশন',
        'form' => 'মাসিক পেনশন ফর্ম',
        'index' => '',
        'list' => 'মাসিক পেনশন তালিকা',
        'basic' => 'বেসিক',
        'medical' => 'চিকিৎসা ভাতা',
        'bonus' => 'বোনাস',
        'adjustment' => 'সমন্বয় (কর্তন)',
        'bonus_if_any' => 'বোনাস (প্রযোজ্য ক্ষেত্রে)',
        'no_employee_selected' => 'কোন এমপ্লয়ী নির্বাচন করা হয়নি! এমপ্লয়ী তালিকা লোড করে অন্তত একজন এমপ্লয়ী নির্বাচন করুন',
        'disburse' => 'বিতরণ সম্পন্ন করুন',
        'disburse_date' => 'বিতরণের তারিখ',
        'monthly_pension_record' => 'মাসিক পেনশন রেকর্ড',
        'monthly_pension_records' => 'মাসিক পেনশন রেকর্ডসমূহ ',
        'download_bill' => 'মাসিক পেনশন বিল ডাউনলোড করুন',
        'bill_receivable' => 'প্রাপ্য বিল',
        'no_bill' => 'কোন প্রাপ্য বিল নেই!',
        'bonus_only' => 'শুধুমাত্র বোনাস ',
        'only_bonus_error' => "শুধুমাত্র বোনাস টিক থাকা অবস্থায় অন্তত একটি বোনাস সিলেক্ট করুন",
        'select_month' => 'অনুগ্রহ করে পেনশন মাস ইনপুট দিন'
    ],
    'contract' => [
        'create' => 'পেনশন চুক্তি তৈরি',
        'title' => 'পেনশন চুক্তি',
        'form' => 'পেনশন চুক্তি ফর্ম',
        'index' => '',
        'list' => 'পেনশন চুক্তি তালিকা',
        'initial_basic' => 'প্রারম্ভিক বেসিক',
        'current_basic' => 'বর্তমান বেসিক',
        'receiver' => 'পেনশন গ্রহীতা',
        'receiver_age' => 'পেনশন গ্রহীতার বয়স',
        'increment_percentage' => 'পেনশন বৃদ্ধির শতকরা পরিমান (%)',
        'disburse_type' => 'বিতরণ মাধ্যম',
        'bank_account_info' => 'ব্যাংক একাউন্ট তথ্য',
        'bank' => 'ব্যাংক',
        'cash' => 'ক্যাশ',
        'ppo_no' => 'পিপিও নম্বর',
        'has_payroll_increment' => 'ইনক্রিমেন্ট প্রাপ্য কিনা'
    ],
    'configuration' => [
        'create' => 'পেনশন কনফিগারেশন তৈরি করুন',
        'title' => 'পেনশন কনফিগারেশন',
        'short_title' => 'পেনশন কনফিগারেশন',
        'index' => 'পেনশন কনফিগারেশন তালিকা',
        'form' => 'পেনশন কনফিগারেশন ফর্ম',
        'error_message' => 'পেনশন কনফিগারেশন খুঁজে পাওয়া যায় নি',
        'form_elements' => [
            'title' => 'শিরোনাম',
            'percentage' => 'পেনশন শতাংশ',
            'lump_sum_number' => 'আনুতোষিক পরিশোধ সংখ্যা',
            'lump_sum_percentage' => 'আনুতোষিক পরিশোধ শতাংশ',
            'monthly_pension_percentage' => 'মাসিক পেনশন শতাংশ',
            'minimum_pension_amount' => 'সর্বনিম্ন পেনশনের পরিমাণ',
            'medical_allowance_increment_age' => 'মেডিকেল বৃদ্ধির বয়স',
            'medical_allowance_after_increment' => 'চিকিৎসা ভাতা (বৃদ্ধির পরে)',
            'initial_medical_allowance' => 'প্রাথমিক মেডিকেল ভাতা',
            'status' => [
                'active' => 'এক্টিভ',
                'inactive' => 'ইনেক্টিভ',
            ]
        ],
    ],

    'rule' => [
        'create' => 'পেনশন বিধি তৈরি করুন',
        'title' => 'পেনশন বিধি',
        'short_title' => 'বিধি',
        'index' => 'পেনশন বিধি তালিকা',
        'form' => 'পেনশন বিধি ফর্ম',
        'error_message' => 'পেনশনের বিধি পাওয়া যায় নি',
        'form_elements' => [
            'name' => 'নাম',
            'type' => 'টাইপ',
            'condition' => 'শর্ত',
            'amount_type' => 'পরিমানের ধরন',
            'percentage_amount' => 'শতাংশের পরিমাণ (বেসিক)',
            'fixed_amount' => 'নির্দিষ্ট পরিমাণ',
        ],
    ],

    'report' => [
        'title' => 'পেনশন রিপোর্ট',
        'sonali_bank_acc_no' => 'সোনালি ব্যাংক কোটবাড়ি শাখা সঞ্চয়ী হিসাব নং',
        'tk' => 'টাকা',
        'report_headline' => 'কর্মচারীদের :month মাসের পেনশন ও নামের তালিকা'
    ],

    'nominee' => [
        'title' => 'পেনশন নমিনী',
        'form' => 'পেনশন নমিনী ফর্ম',
        'list' => 'পেনশন নমিনী তালিকা',
        'show' => 'পেনশন নমিনী প্রদর্শন',
        'add' => 'নমিনী তৈরি করুন',
        'employee_details' => 'কর্মচারী বিস্তারিত',
        'nominee_details' => 'নমিনী বিস্তারিত',
        'nominee_name' => 'নমিনীর নাম (এনআইডি/জন্মসনদ অনুসারে)',
        'birth_date' => 'নমিনীর জন্মতারিখ',
        'relation' => 'কর্মচারীর সাথে সম্পর্ক',
        'age_limit' => 'পেনশন প্রাপ্তির বয়সসীমা',
        'nominee' => 'নমিনী',
        'self' => 'নিজ',
        'age_limit_message' => 'লাইফটাইম পেনশনের জন্য, স্থানটি ফাঁকা করুন'
    ]
];

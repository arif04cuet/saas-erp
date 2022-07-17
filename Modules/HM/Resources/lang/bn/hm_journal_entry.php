<?php


return [
    'journal_entry' => [
        'title' => 'হোস্টেল জার্নাল এন্ট্রি',
        'index' => 'হোস্টেল জার্নাল এন্ট্রি তালিকা',
        'form' => 'হোস্টেল জার্নাল এন্ট্রি ফর্ম',
        'create' => 'হোস্টেল জার্নাল এন্ট্রি তৈরি করুন',
        'form_elements' => [
            'date' => trans('labels.date'),
            'title' => trans('labels.title'),
            'journal' => 'জার্নাল',
        ]
    ],
    'journal_entry_details' => [
        'title' => 'হোস্টেল জার্নাল এন্ট্রি বিস্তারিত',
        'index' => 'হোস্টেল জার্নাল এন্ট্রি বিস্তারিত তালিকা',
        'form' => 'হোস্টেল জার্নাল এন্ট্রি বিস্তারিত ফর্ম',
        'form_elements' => [
            'remark' => trans('labels.remarks'),
            'transaction_type' => 'লেনদেন প্রকার',
            'tms_code' => 'হোস্টেল কোড',
            'debit_amount' => 'ডেবিট অর্থ',
            'credit_amount' => 'ক্রেডিট অর্থ',
        ]
    ],
    'flash_messages' => [
        'budget_max_value_exceeded' => 'কোডঃ :code  এর জন্য বাজেট অতিক্রম করেছে ।'
    ]
];

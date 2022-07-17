<?php


return [
    'journal_entry' => [
        'title' => 'প্রশিক্ষণ জার্নাল এন্ট্রি',
        'index' => 'প্রশিক্ষণ জার্নাল এন্ট্রি তালিকা',
        'form' => 'প্রশিক্ষণ জার্নাল এন্ট্রি ফর্ম',
        'create' => 'প্রশিক্ষণ জার্নাল এন্ট্রি তৈরি করুন',
        'form_elements' => [
            'date' => trans('labels.date'),
            'title' => trans('labels.title'),
            'journal' => 'জার্নাল',
        ]
    ],
    'journal_entry_details' => [
        'title' => 'প্রশিক্ষণ জার্নাল এন্ট্রি বিস্তারিত',
        'index' => 'প্রশিক্ষণ জার্নাল এন্ট্রি বিস্তারিত তালিকা',
        'form' => 'প্রশিক্ষণ জার্নাল এন্ট্রি বিস্তারিত ফর্ম',
        'form_elements' => [
            'remark' => trans('labels.remarks'),
            'transaction_type' => 'লেনদেন প্রকার',
            'tms_code' => 'প্রশিক্ষণ কোড',
            'debit_amount' => 'ডেবিট অর্থ',
            'vat' => 'ভ্যাট',
            'tax' => 'আইটি ',
            'employee' => 'কর্মচারী',
        ]
    ],
    'flash_messages' => [
        'budget_max_value_exceeded' => 'কোডঃ :code  এর জন্য হোস্টেল বাজেট অতিক্রম করেছে ।',
        'budget_not_found' => 'কোডঃ :code  এর জন্য হোস্টেল বাজেট খুঁজে পাওয়া যায়নি',
        'code_setting_not_found' => ':sector এর কোড সেটিং পাওয়া যায় নি',
        'vat_tax_sub_sector' => 'বাজেটে ভ্যাট ও ট্যাক্স সাব সেক্টরটি নির্বাচন করুন!'
    ]
];

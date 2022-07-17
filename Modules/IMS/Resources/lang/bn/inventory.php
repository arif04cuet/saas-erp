<?php

return [
    'title' => 'ইনভেন্টরি',
    'list_menu_title' => 'ইনভেন্টরি তালিকা',
    'list_page_title' => 'ইনভেন্টরি তালিকা',
    'add_menu_title' => 'ইনভেন্টরিতে পণ্য সংযোজন',
    'add_page_title' => 'ইনভেন্টরিতে পণ্য সংযোজন',

    'item' => [
        'title' => 'ইনভেন্টরি আইটেম',
        'request' => 'আইটেম অনুরোধ',
        'menu_title' => 'আইটেম তালিকা',
        'create' => 'নতুন ইনভেন্টরি আইটেম',
        'edit' => 'ইনভেন্টরি আইটেম সম্পাদনা',
        'edit_form_title' => 'ইনভেন্টরি আইটেম সম্পাদনা ফর্ম',
        'model' => 'মডেল',
        'unit_price' => 'মূল্য (প্রতি ইউনিট)',
        'invoice_no' => 'চালান নং',
        'unique_id' => 'আইডি',
        'new_item' => 'নতুন ইনভেন্টরি আইটেম ইনপুট',
        'existing_item' => 'বিদ্যমান ইনভেন্টরি আইটেমসমূহ',
        'view_item' => 'আইটেম দেখুন',
        'view_item_label' => ':category ক্যাটাগরির আইটেম দেখুন',
        'view_location_item_label' => ':location লোকেশনের আইটেম দেখুন',
        'select_item' => 'আইটেম নির্বাচন করুন',
        'select_item_label' => ':category এর জন্য আইটেম নির্বাচন করুন',
        'no_location' => '- কোন লোকেশনে হস্তান্তর করা হয়নি -',
        'requested' => 'অনুরোধকৃত',
        'given' => 'প্রদত্ত',
        'for_fixed_assets' => 'স্থায়ী সম্পদের ক্ষেত্রে',
        'select_error_message' => 'স্থায়ী সম্পদের ক্ষেত্রে অনুরোধকৃত সংখ্যক আইটেম নির্বাচন করতে হবে। অনুগ্রহ করে যাচাইকরণ পূর্বক আবার চেষ্টা করুন! ',
        'timeline' => [
            'title' => 'আইটেম টাইমলাইন',
            'created' => 'আইটেম তৈরি',
            'date' => ':date তারিখে :user কর্তৃক',
            'from_to' => ':from থেকে :to লোকেশনে স্থানান্তর',
            'to' => ':to লোকেশনে স্থানান্তর',
            'end' => 'টাইমলাইন সমাপ্ত'
        ],
        'item_request' => [
            'title' => 'ইনভেন্টরি আইটেম অনুরোধ',
            'create' => 'ইনভেন্টরি আইটেম অনুরোধ তৈরি করুন',
            'index' => 'ইনভেন্টরি আইটেমের অনুরোধ তালিকা',
            'details' => 'ইনভেন্টরি আইটেম অনুরোধ বিস্তারিত ',
            'menu_title' => 'আইটেম অনুরোধ',
            'menu_index' => 'তালিকা',
            'form_elements' => [
                'title' => 'শিরোনাম',
                'purpose' => 'উদ্দেশ্য',
                'reason' => 'কারণ',
                'location' => 'অবস্থান',
                'repeater_title' => 'ইনভেন্টরি আইটেম',
            ],
            'flash_messages' => [
                'store_admin_error' => ' :store জন্য একটি স্টোর অ্যাডমিন নির্বাচন করুন'
            ],
            'notification_messages' => [
                'pending' => ':name একটি ইনভেন্টরি আইটেম অনুরোধ করেছেন ।',
                'approved' => 'আপনার ইনভেন্টরি আইটেম অনুরোধ অনুমোদন করা হয়েছে ।',
                'rejected' => 'আপনার যইনভেন্টরি আইটেম অনুরোধ বাতিল করা হয়েছে ।',
            ],
            'purpose' => [
                'training' => 'প্রশিক্ষণ',
                'others' => 'অন্যান্য'
            ],
            'labels' => [
                'send_to_workflow'=>'অনুমোদনের জন্য প্রেরণ করুন'
            ],
            'status' => [
                'new' => 'নতুন',
                'pending' => 'Pending',
                'approved' => 'অনুমোদিত',
                'rejected' => 'বাতিল'
            ]
        ]
    ],

    'duplicate_select_error' => 'ক্যাটেগরি একাধিকবার নির্বাচন করা যাবে না। অনুগ্রহ করে আবার চেষ্টা করুন! ',
    'quantity_error' => 'পর্যাপ্ত আইটেম বিদ্যমান নেই। অনুগ্রহ করে আবার চেষ্টা করুন!',

    'warehouse' => [
        'list_menu_title' => 'কোষাগার অনুযায়ী পণ্যগার',
        'list_page_title' => 'কোষাগার অনুযায়ী পণ্যগার',
    ],
    'inventory' => 'ইনভেন্টরি',
    'inventory_location' => 'ইনভেন্টরি লোকেশন',

    // Inventory Request
    'inventory_request_form_title' => 'ইনভেন্টরি :type অনুরোধ',
    'inventory_request' => 'ইনভেন্টরি অনুরোধ',
    'inventory_request_info' => 'ইনভেন্টরি অনুরোধ সম্পর্কিত তথ্য',
    'inventory_request_title' => 'ইনভেন্টরি অনুরোধ শিরোনাম',
    'inventory_request_type' => 'ইনভেন্টরি অনুরোধের ধরণ',
    'inventory_request_review_form' => 'ইনভেন্টরি অনুরোধ পর্যালোচনা ফর্ম',
    'inventory_request_types' => [
        'requisition' => 'চাহিদাপত্র',
        'request' => 'অনুরোধ',
        'transfer' => 'হস্তান্তর',
        'scrap' => 'স্ক্র্যাপ',
        'abandon' => 'বর্জিত',
    ],
    'inventory_request_purpose' => 'অনুরোধ উদ্দেশ্য',
    'inventory_request_purposes' => [
        'official' => 'দাপ্তরিক (ব্যক্তিগত)',
        'departmental' => 'বিভাগীয়'
    ],

    'already_bought_inventory' => 'ইতিমধ্যেই অনুরোধকৃত ইনভেন্টরি',
    'inventory_item_category' => 'ইনভেন্টরি আইটেম ক্যাটাগরি',
    'item_category' => 'আইটেম ক্যাটাগরি',
    'item_category_list' => 'আইটেম ক্যাটাগরি তালিকা',
    'all_list' => 'ক্যাটাগরি তালিকা',
    'departmental_item_category_list' => "বিভাগীয় ক্যাটাগরি তালিকা",
    'departmental_list' => "বিভাগীয় তালিকা",
    'create_new_category' => 'নতুন ক্যাটাগরি তৈরি',
    'short_code' => 'শর্ট কোড',
    'type' => 'সম্পদের ধরন',
    'unit' => 'একক',
    'add_new_item_category' => 'নতুন আইটেম ক্যাটাগরি সংযোজন',
    'new_item_category' => 'নতুন আইটেম ক্যাটাগরি',
    'category' => 'ক্যাটাগরি',
    'new-category' => ' নতুন ক্যাটাগরি',
    'bought-category' => 'ইতিমধ্যেই কেনা ক্যাটাগরি',
    'fixed_asset' => 'স্থায়ী সম্পদ',
    'temporary_asset' => 'অস্থায়ী সম্পদ',
    'stationery' => 'স্টেশনারি',
    'item_category_edit' => 'আইটেম ক্যাটাগরি সম্পাদনা',
    'item_category_details' => 'আইটেম ক্যাটাগরি বিস্তারিত',
    'recipients' => [
        'title' => 'প্রাপক',
        'error_message' => 'একজন প্রাপক আবশ্যক'
    ],
    'remark' => [
        'title' => 'মন্তব্য',
        'error_message' => 'মন্তব্য আবশ্যক',
        'placeholder' => 'আপনার মন্তব্য জুড়ুন'
    ],
    'send_to' => 'যাকে পাঠাবেন',
    'message' => [
        'title' => 'বার্তা',
        'placeholder' => 'বার্তা লিখুন'
    ],
    'location' => 'অবস্থান',
    'quantity' => 'পরিমাণ',
    'total' => 'মোট',
    'location_transitions' => 'অবস্থান স্থানান্তর',
    'price' => 'মূল্য',
    'minimum_price_message' => 'সর্বনিম্ন মূল্য দিতে হবে 1',
    'maximum_price_message' => 'আপনি সর্বাধিক 9999999 মূল্য প্রবেশ করতে পারেন',
    'valid_number_message' => 'আপনি যে নম্বরটি লিখেছেন তা সঠিক নয়',
];

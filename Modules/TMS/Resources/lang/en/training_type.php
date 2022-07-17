<?php

return [

    'title' => 'Training Type',
    'create' => 'Create Training Types',
    'training_type' => 'Create Training Types',
    'edit' => 'প্রশিক্ষণের ধরন সম্পাদনা করুন',
    'index' => 'Training Type List',
    'menu_title' => 'প্রশিক্ষণ',
    'form' => 'প্রশিক্ষণ ফর্ম',
    'details' => 'Training Type Details',
    'form_elements' => [
        'name_english' => 'Name (English)',
        'name_bangla' => 'Name (Bangla)',
        'name' => 'Name',
        'parent' => 'Parent Name',
    ],
    'msg' =>[
        'requied' =>'This Field is Required',
        'max' =>'Max Capacity is 200',
        'min' =>'Min Capacity is 1',
        'regex'=>[
            'bn' => 'must be in Bangla language',
            'eng'=> 'must be in English language',
        ],
        'unique' => ' Short Code must be unique ',
        'num' => 'capacity must be a number',
    ],
];

<?php

return [
    'manue_title'=>'Venues',
    'venue'=>'Venues',
    'title' => [
        'index' =>  'Venue List',
        'create'=>  'Create New Venue',
        'edit'  =>  'Edit Venue',
        'show'  =>  'Venue Details',
        'default'=>'Venues'
    ],
    
    
    'button' =>[
        'index'=> 'List',
        'create' => 'Add New Venue',
        'edit' => 'Edit',
        'show' => 'Details',
    ],

    'th' => [
        'serial' => 'Serial',
        'name' => 'Name',
        'name_bn' => 'Name ( English )',
        'name_eng' => 'Name ( Bangle )',
        'capacity'=> 'Capacity',
        'short_code'=> 'Short Code',
        'action' => 'Action',
    ],
    
    'form' => [
        'name'=>[
            'bn'=>'Name ( Bangla )',
            'eng'=>'Name ( English )',
        ],
        'capacity'=>'Capacity',
        'short code'=>'Short Code',
    ],

    'msg' =>[
        'requied' =>'This Field is Required',
        'max' =>'Max Capacity is 1000',
        'min' =>'Min Capacity is 1',
        'regex'=>[
            'bn' => 'must be in Bangla language',
            'eng'=> 'must be in English language',
        ],
        'unique' => ' Short Code must be unique ',
        'num' => 'capacity must be a number',
    ],

    'placeholder'=>[
        'name' => [
            'bn'  => 'Enter Venue Name In Bengle',
            'eng' => 'Enter Venue Name In English',
        ],
        'capacity' => 'Enter Venue Capacity',
        'short code' => 'Enter Short Code For Venue',
    ],
    'select_venue' => 'Select Venue'

   
];

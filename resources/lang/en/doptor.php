<?php
return [
    'manue_title'=>'Doptor',
    'doptor'=>'Doptor',
    'doptor_management' => 'Doptor Management',
    'title' => [
        'index' =>  'Doptor List',
        'create'=>  'Create New Doptor',
        'edit'  =>  'Edit Doptor',
        'show'  =>  'Doptor Details',
        'default'=>'Doptor'
    ],
    
    
    'button' =>[
        'index'=> 'List',
        'create' => 'Add New Doptor',
        'edit' => 'Edit',
        'show' => 'Details',
        'delete' => 'Delete',
    ],

    'th' => [
        'serial' => 'Serial',
        'name' => 'Name',
        'name_bn' => 'Name ( English )',
        'name_en' => 'Name ( Bangle )',
        'capacity'=> 'Capacity',
        'short_code'=> 'Short Code',
        'action' => 'Action',
        'active' => 'Active',
        'inactive' => 'InActive',
        'status' => 'Status',
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
        'max' =>'Max Capacity is 200',
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
            'bn'  => 'Enter Doptor Name In Bengle',
            'eng' => 'Enter Doptor Name In English',
        ],
        'capacity' => 'Enter Doptor Capacity',
        'short code' => 'Enter Short Code For Doptor',
    ],
    'select_doptor' => 'Select Doptor'

   
];
<?php

return [
    'title' => 'Fuel log book',
    'create' => 'Create ',
    'index' => 'Fuel Log List',
    'menu_title' =>  'Fuel bill',
    'details' => 'Fuel log details',
    'registration' => 'Add new',
    'form_elements' => [
        'vehicle' => 'Vehicle',
        'type' => 'Vehicle type',
        'fuel_type' => 'Fuel type',
        'fuel_quantity'=>'Fuel quantity',
        'amount'=>'Amount',
        'voucher_number'=>'Voucher number',
        'filling_station' => 'Filling station',
        'attachment'=>'Attachment'

    ],
    'unique' => 'This filling station name already use',
    'attachment' => 'Attachment',
    'status' => [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'completed' => 'Completed',
        'rejected' => 'Rejected',
    ],
    'fuel_type'=>[
        'gas' => 'Gas',
        'oil'=>'Oil'
    ],
    'voucher_attachment'=>'Voucher attachment',
    'image_size'=>'Photo (maximum size 3 MB)',
    'report'=>'Report',
    'notification_messages' => [
        'start' => 'A Vehicle Fuel Bill Request Has Made By :name',
        'approved' => 'Your Fuel Bill Request Has Been Approved',
        'rejected' => 'Your Fuel Bill Request Has Been Rejected',
        'completed' => 'Your Fuel Bill Has Been Completed',
        'cancelled' => 'Your Fuel Bill Request Has Been Cancelled',
        'pending' => 'Your Fuel Bill Request Is Pending'
    ]
];

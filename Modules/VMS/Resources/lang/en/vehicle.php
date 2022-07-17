<?php
return [
    'title' => 'Vehicle',
    'menu_title' => 'Vehicle',
    'create' => 'Create Vehicle',
    'index' => 'Vehicle List',
    'details' => 'Vehicle Details',
    'add_driver' => 'Add Driver',
    'type' => [
        'title' => 'Vehicle Type',
        'menu_title' => 'Vehicle Type',
        'create' => 'Create Vehicle Type',
        'index' => 'Vehicle Type List',
        'edit' => 'Edit Vehicle Type',
        'details' => 'Vehicle Type Details',
        'form_elements' => [
            'title_english' => 'Name (English)',
            'title_bangla' => 'Name (Bangla)',
            'code' => 'Code',
        ]
    ],
    'fuel_type' => [
        'title' => 'Fuel Type',
        'gas' => 'Gas',
        'oil' => 'Oil'
    ],
    'status' => [
        'available' => 'Available',
        'booked' => 'Booked',
        'under_maintenance' => 'Under Maintenance',
        'unavailable' => 'Unavailable'
    ],
    'form_elements' => [
        'type' => 'Vehicle Type',
        'name' => trans('labels.name'),
        'model' => 'Model',
        'registration_number' => 'Registration Number',
        'price' => 'Price',
        'seat' => 'Seat',
        'cc' => 'CC',
        'chassis_number' => 'Chassis Number',
        'purchase_date' => 'Purchase Date',
        'insurance' => 'Insurance',
        'fitness' => 'Fitness',
        'fuel_type' => 'Fuel Type',
        'vehicle_type_id' => 'Vehicle Type',
    ]
];

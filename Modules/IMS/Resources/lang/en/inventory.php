<?php

return [
    'title' => 'Inventory',
    'list_menu_title' => 'Inventory List',
    'list_page_title' => 'Inventory List',
    'add_menu_title' => 'Add product into inventory',
    'add_page_title' => 'Add product into inventory',

    'item' => [
        'title' => 'Inventory Item',
        'request' => 'Inventory Request',
        'menu_title' => 'Inventory Items',
        'create' => 'New Inventory Item',
        'edit' => 'Edit Inventory Item',
        'edit_form_title' => 'Inventory Item Edit Form',
        'model' => 'Model',
        'unit_price' => 'Unit Price',
        'invoice_no' => 'Invoice No.',
        'unique_id' => 'ID',
        'new_item' => 'New Inventory Items to Add',
        'existing_item' => 'Existing Inventory Items',
        'view_item' => 'View Items',
        'view_item_label' => 'Show Items of :category Category',
        'view_location_item_label' => 'Show Items from :location',
        'select_item' => 'Select Items',
        'select_item_label' => 'Select Items for :category',
        'no_location' => '- Not Assigned to any Location  -',
        'requested' => 'Requested',
        'given' => 'Given',
        'for_fixed_assets' => 'For Fixed Asset',
        'select_error_message' => 'You have to select requested number of items for fixed assets. Please check and retry!',
        'timeline' => [
            'title' => 'Item Timeline',
            'created' => 'Item Created',
            'date' => 'On :date by :user',
            'from_to' => 'From :from to :to',
            'to' => 'To :to',
            'end' => 'End of Timeline'
        ],
        'item_request' => [
            'title' => 'Inventory Item Request',
            'create' => 'Create Inventory Item Request',
            'index' => 'Inventory Item Request List',
            'details' => 'Inventory Item Request Detail',
            'menu_title' => 'Item Request',
            'menu_index' => 'List',
            'form_elements' => [
                'title' => 'Title',
                'purpose' => 'Purpose',
                'reason' => 'Reason',
                'location' => 'Location',
                'repeater_title' => 'Inventory Item',
            ],
            'notification_messages' => [
                'start' => 'An Inventory Trip Request Has Made By :name',
                'approved' => 'Your Trip Request Has Been Approved',
                'rejected' => 'Your Trip Request Has Been Rejected',
            ],
            'flash_messages' => [
                'store_admin_error' => 'Please Select A Store Admin For :store'
            ],
            'purpose' => [
                'training' => 'Training',
                'others' => 'Others',
            ],
            'labels' => [
                'send_to_workflow' => 'Send For Approval'
            ],
            'status' => [
                'new' => 'New',
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'rejected'
            ]
        ]
    ],
    'duplicate_select_error' => 'Category can be selected only once. Please check and retry!',
    'quantity_error' => 'Quantity not available for transfer. Please retry!',

    'warehouse' => [
        'list_menu_title' => 'Warehouse wise inventory',
        'list_page_title' => 'Warehouse wise inventory',
    ],
    'inventory' => 'Inventory',
    'inventory_location' => 'Inventory Location',

    // Inventory Request
    'inventory_request_form_title' => 'Inventory :type Request',
    'inventory_request' => 'Inventory Request',
    'inventory_request_info' => 'Inventory Request Information',
    'inventory_request_title' => 'Inventory Request Title',
    'inventory_request_type' => 'Inventory Request Type',
    'inventory_request_review_form' => 'Inventory Request Review Form',
    'inventory_request_types' => [
        'requisition' => 'Requisition',
        'request' => 'Request',
        'transfer' => 'Transfer',
        'scrap' => 'Scrap',
        'abandon' => 'Abandon',
    ],
    'inventory_request_purpose' => 'Request Purpose',
    'inventory_request_purposes' => [
        'official' => 'Official (Personal)',
        'departmental' => 'Departmental'
    ],

    'already_bought_inventory' => 'Already Requested Inventory',
    'inventory_item_category' => 'Inventory Category',
    'item_category' => 'Item Category',
    'item_category_list' => 'Item Category',
    'all_list' => 'Category List',
    'departmental_item_category_list' => 'Departmental List',
    'departmental_list' => 'Departmental List',
    'create_new_category' => 'Create New Category',
    'short_code' => 'Short Code',
    'type' => 'Asset Type',
    'unit' => 'Unit',
    'add_new_item_category' => 'Add New Item Category',
    'new_item_category' => 'New Item Category',
    'category' => 'Category',
    'new-category' => 'New Category',
    'bought-category' => 'Bought Category',
    'fixed_asset' => 'Fixed Asset',
    'temporary_asset' => 'Temporary Asset',
    'stationery' => 'Stationery',
    'item_category_edit' => 'Update Item Category',
    'item_category_details' => 'Item Category Details',
    'recipients' => [
        'title' => 'Recipients',
        'error_message' => 'Must select a recipient.'
    ],
    'remark' => [
        'title' => 'Remark',
        'error_message' => 'Must add a remark',
        'placeholder' => 'Place your remark'
    ],
    'send_to' => 'Send To',
    'message' => [
        'title' => 'Message',
        'placeholder' => 'Leave a message'
    ],
    'location' => 'Location',
    'quantity' => 'Quantity',
    'total' => 'Total',
    'location_transitions' => 'Location Transitions',
    'price' => 'Price',
    'minimum_price_message' => 'Minimum price should be 1',
    'maximum_price_message' => 'Maximum price should be 9999999',
    'valid_number_message' => 'Please enter a valid number',
];

<?php

return [
    'journal_entry' => [
        'title' => 'Hostel Journal Entry',
        'create' => 'Create Hostel Journal Entry',
        'index' => 'Hostel Journal Entry List',
        'form' => 'Hostel Journal Entry Form',
        'form_elements' => [
            'date' => trans('labels.date'),
            'title' => trans('labels.title'),
            'journal' => 'Journal',
        ]
    ],
    'journal_entry_details' => [
        'title' => 'Hostel Journal Entry Detail',
        'index' => 'Hostel Journal Entry Detail List',
        'form' => 'Hostel Journal Entry Detail Form',
        'form_elements' => [
            'remark' => trans('labels.remarks'),
            'transaction_type' => 'Transaction Type',
            'tms_code' => 'Tms Code',
            'debit_amount' => 'Debit Amount',
            'credit_amount' => 'Credit Amount',
        ]
    ],
    'flash_messages' => [
        'budget_max_value_exceeded' => 'Budget Exceeded For the Code : code'
    ]
];

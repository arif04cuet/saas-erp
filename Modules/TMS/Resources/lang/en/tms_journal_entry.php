<?php

return [
    'journal_entry' => [
        'title' => 'TMS Journal Entry',
        'create' => 'Create TMS Journal Entry',
        'index' => 'TMS Journal Entry List',
        'form' => 'Training Journal Entry Form',
        'form_elements' => [
            'date' => trans('labels.date'),
            'title' => trans('labels.title'),
            'journal' => 'Journal',
        ]
    ],
    'journal_entry_details' => [
        'title' => 'TMS Journal Entry Detail',
        'index' => 'TMS Journal Entry Detail List',
        'form' => 'TMS Journal Entry Detail Form',
        'form_elements' => [
            'remark' => trans('labels.remarks'),
            'transaction_type' => 'Transaction Type',
            'tms_code' => 'Tms Code',
            'debit_amount' => 'Debit Amount',
            'credit_amount' => 'Credit Amount',
            'vat' => 'Vat',
            'tax' => 'Tax',
            'employee' => 'Employee',
        ]
    ],
    'flash_messages' => [
        'budget_max_value_exceeded' => 'Hostel Budget Exceeded For :code',
        'budget_not_found' => 'Hostel Budget Not Found For  :code',
        'code_setting_not_found' => 'Code Setting Not Found For :sector',
        'vat_tax_sub_sector' => 'Please Select Vat & Tax Sub Sector In Budget !'
    ]
];

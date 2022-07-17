<?php

return [
    'title' => 'Journal',
    'create' => 'Create',
    'update' => 'Update',
    'edit' => 'Edit',
    'details' => 'Journal Details',
    'index' => 'Journal List',
    'view' => 'View Journal',
    'description' => 'Description',
    'debit' => 'Debit Account',
    'credit' => 'Credit Account',
    'type' => [
        'sale' => 'Sale',
        'purchase' => 'Purchase',
        'cash' => 'Cash',
        'bank' => 'Bank',
        'others' => 'Others',
    ],
    'label' => [
        'debit' => 'Select a debit account',
        'credit' => 'Select a credit account',
    ],
    'table' => [
        'name' => 'Name',
        'type' => 'Type',
        'department' => 'Department',
    ],
    'entry' => [
        'title' => 'Journal Entry',
        'create' => 'Create Journal Entry',
        'update' => 'Update Journal Entry',
        'edit' => 'Edit Journal Entry',
        'details' => 'Journal Entry Details',
        'index' => 'Journal Entry List',
        'view' => 'View Journal Entry',
        'debit' => 'Debit Amount',
        'credit' => 'Credit Amount',
        'reference' => 'Reference',
        'error' => 'Debit and Credit amount should match',
        'balance' => 'balance',
        'cash_bank_entry' => 'Cash/Bank Entry',
        'table' => [
            'reference' => 'Reference',
            'journal' => 'Journal',
            'department' => 'Department',
            'sector' => 'Sector',
            'debit' => 'Debit Amount',
            'credit' => 'Credit Amount',
            'employee' => 'Employee',
            'advance_payment' => 'Advance Payment ?'
        ],
        'form_elements' => [
            'source' => 'Source',
            'transaction_type' => 'Type',
            'reference' => 'Reference',
            'journal' => 'Journal',
            'department' => 'Department',
            'sector' => 'Sector',
            'debit' => 'Debit Amount',
            'credit' => 'Credit Amount',
        ],
        'detail' => [
            'title' => 'Journal Entry Detail',
            'index' => 'Journal Entry Detail List',
            'source' => [
                'title' => 'Source',
                'local' => 'Local',
                'revenue' => 'Revenue'
            ],
            'transaction_type' => [
                'title' => 'Transaction Type',
                'receipt' => 'Receipt',
                'payment' => 'Payment',
            ],
            'payment_type' => [
                'title' => 'Payment Type',
                'bank' => 'Bank',
                'cash' => 'Cash',
            ],
        ],
        'cash_book' => [
            'title' => 'Bank/Cash Entry',
            'index' => 'Bank/Cash Entry ',
            'journal_reference' => 'Journal Entry',
            'fiscal_year' => 'Fiscal Year',
            'payment_type' => 'Payment Type',
            'transaction_type' => 'Transaction Type',
            'amount' => 'Amount',
            'status' => 'Status',
            'report' => 'Bank/Cash Entry Report',
        ],
        'advance_payment' => [
            'title' => 'Advance Payment',
            'create' => 'Create Advance Payment',
            'index' => 'Advance Payment List',
            'radio_button' => [
                'payment' => 'Payment',
                'adjustment' => 'Adjustment'
            ],
            'table' => [
                'title' => 'Advance Payment',
                'reference' => 'Reference',
                'employee' => 'Officer/Employee',
                'total_debit_amount' => 'Debit Amount',
                'total_credit_amount' => 'Credit Amount',
            ]
        ]

    ],
    'history' => [
        'title' => 'Transaction History',
        'index' => 'Transaction History List',
        'economy_code' => 'Economy Code',
        'fiscal_year' => 'Fiscal Year',
        'previous_balance' => 'Previous Balance',
        'updated_balance' => 'Updated Balance',
        'report' => 'Transaction History Report'
    ],
    'validation' => [
        'debit_overflow' => 'ডেবিট অর্থ বাজেট লিমিট অতিক্রম করছে',
        'each_debit_overflow' => 'লাল চিহ্নিত ডেবিট অর্থ বাজেট লিমিট অতিক্রম করছে',

    ]

];

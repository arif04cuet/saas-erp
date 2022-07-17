<?php

return [
    'name' => 'Accounts',

    'parent' => 0, // Parent Head won't have any parent

    'head_type_asset' => 1,
    'head_type_liability' => 2,
    'head_type_income' => 3,
    'head_type_expense' => 4,

    'head_type' => [
        1 => "Asset",
        2 => "Liability",
        3 => "Income",
        4 => "Expense"
    ],

    /*
    |--------------------------------------------------------------------------
    | Payments Methods
    |--------------------------------------------------------------------------
    |
    */

    'payment_method' => [
        'cash' => 'Cash',
        'check' => 'Check',
    ],

];

<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'can:guest_access'])->prefix('accounts')->group(function () {

    Route::get('/', 'AccountsController@index')->name('accounts');
    Route::get('show', 'AccountsController@show'); // Temporary & demo
    Route::get('/excel-report-download',
        'PayslipReportController@reportDownload')->name('excel-export-download'); // Temporary & demo
    Route::prefix('/chart-of-accounts')->group(function () {
        Route::get('/', 'ChartOfAccountController@index')->name('chart-of-accounts.index');
        Route::post('/import', 'ChartOfAccountController@store')->name('chart-of-accounts.store');
        Route::get('/sample/download',
            'ChartOfAccountController@downloadSampleFile')->name('chart-of-accounts.sample.download');
    });
    Route::prefix('account-head')->group(function () {
        Route::get('create', 'AccountHeadController@create')->name('account-head.create');
        Route::post('/', 'AccountHeadController@store')->name('account-head.store');
        Route::get('edit/{id}', 'AccountHeadController@edit')->name('account-head.edit');
        Route::put('update/{id}', 'AccountHeadControl   ler@update')->name('account-head.update');
        Route::delete('delete/{id}', 'AccountHeadController@destroy')->name('account-head.destroy');
    });
    Route::prefix('account-ledger')->group(function () {
        Route::get('create', 'AccountLedgerController@create')->name('account-ledger.create');
        Route::post('/', 'AccountLedgerController@store')->name('account-ledger.store');
        Route::get('edit/{id}', 'AccountLedgerController@edit')->name('account-ledger.edit');
        Route::put('update/{id}', 'AccountLedgerController@update')->name('account-ledger.update');
        Route::delete('delete/{id}', 'AccountLedgerController@destroy')->name('account-ledger.destroy');
    });
    Route::prefix('economy-code')->group(function () {
        Route::get('/', 'EconomyCodeController@index')->name('economy-code.index');
        Route::get('create', 'EconomyCodeController@create')->name('economy-code.create');
        Route::post('store', 'EconomyCodeController@store')->name('economy-code.store');
        Route::get('edit/{economyCode}', 'EconomyCodeController@edit')->name('economy-code.edit');
        Route::put('update/{economyCode}', 'EconomyCodeController@update')->name('economy-code.update');
        Route::delete('delete/{economyCode}', 'EconomyCodeController@destroy')->name('economy-code.destroy');
    });
    Route::prefix('economy-head')->group(function () {
        Route::get('/', 'EconomyHeadController@index')->name('economy-head.index');
        Route::get('create', 'EconomyHeadController@create')->name('economy-head.create');
        Route::post('store', 'EconomyHeadController@store')->name('economy-head.store');
        Route::get('edit/{economyHead}', 'EconomyHeadController@edit')->name('economy-head.edit');
        Route::put('update/{economyHead}', 'EconomyHeadController@update')->name('economy-head.update');
        Route::delete('delete/{economyHead}', 'EconomyHeadController@destroy')->name('economy-head.destroy');
    });
    Route::prefix('fiscal-year')->group(function () {
        Route::get('/', 'FiscalYearController@index')->name('fiscal-year.index');
        Route::get('create', 'FiscalYearController@create')->name('fiscal-year.create');
        Route::post('store', 'FiscalYearController@store')->name('fiscal-year.store');
        Route::get('edit/{fiscalYear}', 'FiscalYearController@edit')->name('fiscal-year.edit');
        Route::put('update/{fiscalYear}', 'FiscalYearController@update')->name('fiscal-year.update');
        Route::delete('delete/{fiscalYear}', 'FiscalYearController@destroy')->name('fiscal-year.destroy');
    });
    // Journal  Url's
    Route::prefix('journals')->group(function () {
        ;
        Route::get('/', 'JournalController@index')->name('journal.index');
        Route::post('/', 'JournalController@store')->name('journal.store');
        Route::get('/create', 'JournalController@create')->name('journal.create');
        Route::get('/{journal}/edit', 'JournalController@edit')->name('journal.edit');
        Route::put('/{journal}', 'JournalController@update')->name('journal.update');
        Route::get('/{journal}', 'JournalController@show')->name('journal.show');
        Route::get('/{journal}/details', 'JournalController@detail')->name('journal.details');

    });
    // Journal Entry Url's
    Route::prefix('journal-entries')->group(function () {
        Route::get('/create', 'JournalEntryController@create')->name('journal.entry.create');
        Route::get('/', 'JournalEntryController@index')->name('journal.entry.index');
        Route::post('/', 'JournalEntryController@store')->name('journal.entry.store');
        Route::get('/{id}', 'JournalEntryController@show')->name('journal.entry.show');
    });
    // Cash Book Url's
    Route::prefix('cash-book-entries')->group(function () {
        Route::get('/create', 'CashBookEntryController@create')->name('cash-book-entry.create');
        Route::get('/', 'CashBookEntryController@index')->name('cash-book-entry.index');
        Route::post('/', 'CashBookEntryController@store')->name('cash-book-entry.store');
        Route::get('/{id}', 'CashBookEntryController@show')->name('cash-book-entry.show');
        Route::post('/filter', 'CashBookEntryController@filterAsJson')->name('cash-book-entry.filter');
        Route::get('/status/{id}/{status}',
            'CashBookEntryController@changeStatus')->name('cash-book-entry.status');
    });
    // Account Transaction History Url's
    Route::prefix('transaction-histories')->group(function () {
        Route::get('/create', 'AccountTransactionHistoryController@create')->name('account-transaction-history.create');
        Route::get('/', 'AccountTransactionHistoryController@index')->name('account-transaction-history.index');
        Route::post('/', 'AccountTransactionHistoryController@store')->name('account-transaction-history.store');
        Route::get('/{id}', 'AccountTransactionHistoryController@show')->name('account-transaction-history.show');
        Route::post('/filter',
            'AccountTransactionHistoryController@filterAsJson')->name('account-transaction-history.filter');
    });
    // Account Balance History Url's
    Route::prefix('account-balances')->group(function () {
        Route::get('/create', 'AccountBalanceController@create')->name('account-balance.create');
        Route::get('/', 'AccountBalanceController@index')->name('account-balance.index');
        Route::post('/', 'AccountBalanceController@store')->name('account-balance.store');
        Route::get('/{id}', 'AccountBalanceController@show')->name('account-balance.show');
        Route::post('/filter', 'AccountBalanceController@filterAsJson')->name('account-balance.filter');
    });
    // Invoice Url's
    Route::prefix('invoices')->group(function () {
        //todo::  Using AccountsController For Now (UI purpose)
        Route::get('/create', 'AccountsController@invoiceCreate')->name('invoice.create');
        Route::get('/', 'AccountsController@invoiceIndex')->name('invoice.index');
    });
    // Bill Url's
    Route::prefix('bills')->group(function () {
        Route::get('/create', 'BillController@create')->name('accounts.bill.create');
        Route::get('/', 'BillController@index')->name('accounts.bill.index');
    });
    // Payroll Url's
    Route::prefix('payroll')->group(function () {
        Route::prefix('salary-rule')->group(function () {
            Route::get('/', 'Payroll\SalaryRuleController@index')->name('salary-rule.index');
            Route::get('/create', 'Payroll\SalaryRuleController@create')->name('salary-rule.create');
            Route::post('store', 'Payroll\SalaryRuleController@store')->name('salary-rule.store');
            Route::get('show/{id}', 'Payroll\SalaryRuleController@show')->name('salary-rule.show');
            Route::get('edit/{id}', 'Payroll\SalaryRuleController@edit')->name('salary-rule.edit');
            Route::put('update/{id}', 'Payroll\SalaryRuleController@update')->name('salary-rule.update');
            Route::delete('delete/{id}', 'Payroll\SalaryRuleController@destroy')->name('salary-rule.destroy');
        });
        Route::prefix('salary-category')->group(function () {
            Route::get('/create', 'Payroll\SalaryRuleController@createSalaryCategory')->name('salary-category.create');
            Route::post('/store', 'Payroll\SalaryRuleController@storeSalaryCategory')->name('salary-category.store');
        });
        Route::prefix('contribution-register')->group(function () {
            Route::get('/create', 'Payroll\SalaryRuleController@createContributionRegister')
                ->name('contribution-register.create');
            Route::post('/store', 'Payroll\SalaryRuleController@storeContributionRegister')
                ->name('contribution-register.store');
        });
    });
    // Report Url's
    Route::prefix('reports')->group(function () {
        Route::get('/journal-entry', 'AccountsController@journalEntry')->name('reports.journal-entry');
        Route::post('/show-report', 'AccountsReportController@report')->name('reports.show-report');
        Route::get('/download-report', 'AccountsReportController@downloadreport')->name('reports.download-report');
        Route::get('/settings', 'AccountsReportController@settings')->name('reports.settings');
        Route::post('/settings', 'AccountsReportController@storeSettings')->name('reports.store-settings');
    });
    // Resources for payslip, salary structure, employee contract, payscale, gpf
    Route::resources([
        'economy-sectors' => 'EconomySectorController',
        'economy-code-settings' => 'EconomyCodeSettingController',
        'payslip-batches' => 'PayslipBatchController',
        'salary-structures' => 'SalaryStructureController',
        'employee-contracts' => 'EmployeeContractController',
        'payscales' => 'PayscaleController',
        'gpf' => 'GpfController',
        'gpf-loans' => 'GpfLoanController',
        'gpf-configurations' => 'GpfConfigurationController',
        'payslips-workflow' => 'PayslipWorkflowController',
        // Budget related Resource
        'budgets' => 'AccountsBudgetController',
        'budget-cost-centers' => 'BudgetCostCenterController',
        'cost-centers' => 'CostCenterController',
        'reports' => 'AccountsReportController'
    ]);
    // Budget Related URLs
    Route::prefix('budgets')->group(function () {
        Route::get('/report', 'AccountsBudgetController@report')->name('budgets.report');
        Route::post('/report', 'AccountsBudgetController@showReport')->name('budgets.show-report');
        Route::get('/{budget}', 'AccountsBudgetController@show')->where('budget', '[0-9]+')
            ->name('budgets.show');
        Route::get('/download-report/{budgetId}', 'AccountsBudgetController@downloadReport')
            ->name('budgets.download-report');
//        Route::get('/print-report/{budgetId}', 'AccountsBudgetController@printReport')
//            ->name('budgets.print-report');
    });
    //Gpf Configuration related url
    Route::prefix('gpf-configurations')->group(function () {
        Route::get('/{id}/toggle', 'GpfConfigurationController@toggleActivation')
            ->name('gpf-configurations.toggle-activation');
    });
    // Gpf Related URLs
    Route::prefix('gpf')->group(function () {
        Route::get('/personal-ledger/{employeeId}', 'GpfController@personalLedger')->name('gpf.personal-ledger');
        Route::get('/statement/{id}', 'GpfController@statement')->name('gpf.statement');
        Route::get('/settlement/{employeeId}/{settlementDate?}', 'GpfController@settlement')->name('gpf.settlement');
        Route::post('/settlement/{employeeId}', 'GpfController@storeSettlement')->name('gpf.store-settlement');
    });
    // Gpf Loan Deposit related routes
    Route::prefix('gpf-loan-deposits')->group(function () {
        Route::get('/create/{loanId}', 'GpfLoanDepositController@create')->name('gpf-loan-deposits.create');
        Route::post('/store/{loanId}', 'GpfLoanDepositController@store')->name('gpf-loan-deposits.store');
        Route::post('/update/{loanId}', 'GpfLoanDepositController@update')->name('gpf-loan-deposits.update');
    });
    // Payslip Urls
    Route::prefix('/payslips')->group(function () {
        Route::get('/', 'PayslipController@index')->name('payslips.index');
        Route::post('/', 'PayslipController@store')->name('payslips.store');
        Route::get('/create', 'PayslipController@create')->name('payslips.create');
        Route::get('/{payslip}', 'PayslipController@show')->name('payslips.show');
        Route::post('/filter', 'PayslipController@filter')->name('payslips.filter');
        //report url
        Route::prefix('/reports')->group(function () {
            Route::get('/create', 'PayslipReportController@create')->name('payslips.reports.create');
            Route::post('/filter', 'PayslipReportController@filter')->name('payslips.reports.filter');
            Route::get('/export/{payslip}', 'PayslipReportController@export')->name('payslips.export');
            Route::post('export/batch', 'PayslipReportController@batchExport')->name('payslips.batch.export');
        });
    });
    // Payslip Approval related url
    Route::post('/payslips-workflow/post-create', 'PayslipWorkflowController@postCreate')
        ->name('payslips-workflow.post-create');
    Route::prefix('employee-contracts')->group(function () {
        // URL for employee-contract assign rule import
        Route::prefix('import')->group(function () {
            Route::get('/generate-sample', 'EmployeeContractController@generateSample')
                ->name('employee-contracts.generate-sample');
            Route::get('/contract-data', 'EmployeeContractController@import')->name('employee-contracts.import');
            Route::post('/contract-data', 'EmployeeContractController@import')->name('employee-contracts.load-import');
            Route::post('/store/contract-data', 'EmployeeContractController@storeImported')
                ->name('employee-contracts.store-import');
        });
    });
    // URL for payslip batch create with loading users
    Route::post('payslip-batches/create', 'PayslipBatchController@postCreate')->name('payslip-batches.post-create');
    // URL for payslip view
    Route::get('/payslips/voucher/{id}', 'PayslipController@voucher')->name('payslips.voucher');
    // URL for payscale activation toggle
    Route::get('/payscales/activation/{id}', 'PayscaleController@toggleActivation')->name('payscales.activation');
    //Customer Url's
    Route::prefix('customers')->group(function () {
        Route::get('/', 'CustomerController@index')->name('customer.index');
        Route::get('/create', 'CustomerController@create')->name('customer.create');
    });
    // Vendor Url's
    Route::prefix('vendors')->group(function () {
        Route::get('/', 'CustomerController@vendorIndex')->name('accounts.vendor.index');
        Route::get('/create', 'CustomerController@vendorCreate')->name('accounts.vendor.create');
    });
    // Temporary sector Url's
    Route::prefix('temporary-sectors')->group(function () {
        Route::get('/', 'TemporarySectorController@index')->name('temporary-sectors.index');
        Route::get('/create', 'TemporarySectorController@create')->name('temporary-sectors.create');
        Route::get('/{id}', 'TemporarySectorController@show')->name('temporary-sectors.show');
    });
    // Local Income Url's
    Route::prefix('local-income')->group(function () {
        Route::get('/', 'LocalIncomeController@index')->name('local-income.index');
        Route::get('/create', 'LocalIncomeController@create')->name('local-income.create');
        Route::get('/{id}', 'LocalIncomeController@show')->name('local-income.show');
    });
    // Receipt and Payment Url's
    Route::prefix('receipt-payments')->group(function () {
        Route::get('/', 'ReceiptAndPaymentController@index')->name('receipt-payment.index');
        Route::get('/create', 'ReceiptAndPaymentController@create')->name('receipt-payment.create');
    });
    // Advance Payment Url's
    Route::prefix('advance-payments')->group(function () {
        Route::get('/', 'EmployeeAdvancePaymentController@index')->name('advance-payment.index');
        Route::get('/create', 'EmployeeAdvancePaymentController@create')->name('advance-payment.create');
        Route::get('/{id}', 'EmployeeAdvancePaymentController@show')->name('advance-payment.show');
    });
    // master roll Url's
    Route::prefix('master-roll')->group(function () {

        Route::prefix('/employees')->group(function () {
            Route::get('/create', 'MasterRollEmployeeController@create')->name('master-roll.employee.create');
            Route::get('/', 'MasterRollEmployeeController@index')->name('master-roll.employee.index');
            Route::post('/', 'MasterRollEmployeeController@store')->name('master-roll.employee.store');
            Route::post('/json', 'MasterRollEmployeeController@loadEmployee')->name('master-roll.json.employee');
        });
        Route::prefix('/salaries')->group(function () {
            Route::get('/create', 'MasterRollSalaryController@create')->name('master-roll.salary.create');
            Route::get('/', 'MasterRollSalaryController@index')->name('master-roll.salary.index');
            Route::post('/', 'MasterRollSalaryController@store')->name('master-roll.salary.store');
        });

    });
    // PRL url's
    Route::prefix('/prl')->group(function () {
        Route::get('/create', 'PostRetirementLeaveEmployeeController@create')->name('prl.create');
        Route::get('/', 'PostRetirementLeaveEmployeeController@index')->name('prl.index');
        Route::post('/', 'PostRetirementLeaveEmployeeController@store')->name('prl.store');
        Route::get('/status/{id}', 'PostRetirementLeaveEmployeeController@markAsDisbursed')->name('prl.status');
        // return json
        Route::get('/{id}', 'PostRetirementLeaveEmployeeController@jsonShow')->name('prl.json.show');
    });
    // Pension url's
    Route::prefix('/pensions')->group(function () {
        // lump-sum url's
        Route::prefix('/lump-sums')->group(function () {
            Route::get('/create', 'EmployeeLumpSumController@create')->name('lump-sum.create');
            Route::get('/', 'EmployeeLumpSumController@index')->name('lump-sum.index');
            Route::post('/', 'EmployeeLumpSumController@store')->name('lump-sum.store');
            Route::get('/status/{employeeLumpSum}',
                'EmployeeLumpSumController@markAsDisbursed')->name('lump-sum.status');
            Route::get('/{employeeLumpSum}', 'EmployeeLumpSumController@show')->name('lump-sum.show');
            Route::get('/{employeeLumpSum}/edit', 'EmployeeLumpSumController@edit')->name('lump-sum.edit');
            Route::put('/{employeeLumpSum}', 'EmployeeLumpSumController@update')->name('lump-sum.update');
            // json url
            Route::get('/bill/{id}', 'EmployeeLumpSumController@getBill')->name('lump-sum.bill');
            Route::get('/json/{employeeId}', 'EmployeeLumpSumController@jsonShow')->name('lump-sum.json.show');

        });
        //  pension-deduction url's
        Route::prefix('/deductions')->group(function () {
            Route::get('/', 'PensionDeductionController@index')->name('pension.deduction.index');
            Route::get('/create', 'PensionDeductionController@create')->name('pension.deduction.create');
            Route::post('/', 'PensionDeductionController@store')->name('pension.deduction.store');
            Route::get('/{id}/edit', 'PensionDeductionController@edit')->name('pension.deduction.edit');
            Route::put('/{id}', 'PensionDeductionController@update')->name('pension.deduction.update');
            Route::delete('/{id}', 'PensionDeductionController@destroy')->name('pension.deduction.destroy');
        });
        // Resource controllers related to monthly pension
        Route::resources([
            'monthly-pensions' => 'MonthlyPensionController',
            'monthly-pension-contracts' => 'MonthlyPensionContractController',
            'pension-nominees' => 'PensionNomineeController'
        ]);
        Route::get('monthly-pension-contracts/activate/{id}', 'MonthlyPensionContractController@activate')
            ->name('monthly-pension-contracts.toggle-activation');
        Route::prefix('monthly-pensions')->group(function () {
//            Route::get('/{monthly-pension}', 'MonthlyPensionController@show')->where('monthly-pension', '[0-9]+')
//                ->name('monthly-pensions.show');
            Route::get('/disburse/{monthlyPensionId}', 'MonthlyPensionController@disburse')
                ->name('monthly-pensions.disburse');
            Route::get('/{month?}/{employees?}', 'MonthlyPensionController@index')
                ->name('monthly-pensions.index');
            Route::get('/report/all/show/{month?}', 'MonthlyPensionController@report')->name('monthly-pensions.report');
            Route::get('/get/bill/{employeeId}', 'MonthlyPensionController@getBill')->name('monthly-pensions.bill');
        });
        Route::prefix('/configurations')->group(function () {
            Route::get('/', 'PensionConfigurationController@index')->name('pension-configuration.index');
            Route::post('/', 'PensionConfigurationController@store')->name('pension-configuration.store');
            Route::get('/create', 'PensionConfigurationController@create')->name('pension-configuration.create');
            Route::get('/{pensionConfiguration}',
                'PensionConfigurationController@show')->name('pension-configuration.show');
            Route::get('/{pensionConfiguration}/edit',
                'PensionConfigurationController@edit')->name('pension-configuration.edit');
            Route::put('/{id}', 'PensionConfigurationController@update')->name('pension-configuration.update');
            Route::delete('/{pensionConfiguration}',
                'PensionConfigurationController@destroy')->name('pension-configuration.destroy');
            Route::get('/status/{id}', 'PensionConfigurationController@changeStatus')
                ->name('pension-configuration.status');
        });
    });
    // Promotion Url's
    Route::prefix('/promotions')->group(function () {
        Route::get('/', 'EmployeePromotionController@index')->name('accounts.promotion.index');
        Route::put('/', 'EmployeePromotionController@update')->name('accounts.promotion.update');
    });
    /**
     * Ajax Routes
     * These are the routes that are being used for ajax
     */
    Route::prefix('salary')->group(function () {
        Route::get('/basic/{grade}/{increment}', 'EmployeeContractController@getBasicSalary')->name('salary.basic');
        Route::get('/increments/{grade}', 'EmployeeContractController@getSalaryMaxIncrement')->name('salary.increment');
        Route::get('/contract-assign-rules/{structureId?}/{contractId?}',
            'SalaryStructureController@getContractAssignedRules')->name('salary.contract-assign-rules');
    });
    Route::prefix('pension')->group(function () {
        Route::get('/initial-basic/{employeeId}/{hasIncrement?}', 'MonthlyPensionContractController@getInitialBasic')
            ->name('pension.initial-basic');
        Route::get('/fetch-employees/{month}/{bonuses?}/{onlyBonus?}', 'MonthlyPensionController@fetchPensionEmployees')
            ->name('pension.fetch-pension-employees');
        Route::get('/fetch-nominees/{employeeId}',
            'PensionNomineeController@getNomineesJosn')->name('pension.fetch-nominees');
    });
    Route::prefix('gpf')->group(function () {
        Route::get('/loan-limit/{employeeId}', 'GpfLoanController@gpfLoanLimit')
            ->name('gpf.get-loan-limit');
        Route::get('/percentage/{employeeId}', 'GpfController@getGpfPercentageByEmployeeId')
            ->name('gpf.get-percentage');
    });
    Route::prefix('salary-structures')->group(function () {
        Route::get('json/salary-rules/{salaryStructure}', 'SalaryStructureController@getAllRulesByStructure')
            ->name('salary-structure.rules.json');
    });
    Route::get('/get-sectors/{economyCode}',
        'EconomySectorController@getSectorsJson')->name('economy-code.get-sectors');
    Route::get('journals/get-expense-limit/{economyCode}/{fiscalYearId?}/{date?}',
        'JournalEntryController@expenseLimit')
        ->name('journals.get-expense-limit');

});

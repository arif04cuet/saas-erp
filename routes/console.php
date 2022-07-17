<?php

use Illuminate\Foundation\Inspiring;
use Modules\Accounts\Entities\AccountBalance;
use Modules\Accounts\Entities\AccountTransactionHistory;
use Modules\Accounts\Entities\CashBookEntry;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\PayslipBatch;
use Modules\Accounts\Entities\PayslipDetail;
use Modules\HM\Entities\HmAccountBalance;
use Modules\HM\Entities\HmCashBookEntry;
use Modules\HM\Entities\HmJournalEntry;
use Modules\HM\Entities\HmJournalEntryDetail;
use Modules\TMS\Entities\TmsAccountBalance;
use Modules\TMS\Entities\TmsCashBookEntry;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Entities\TmsJournalEntryDetail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
// clear logs from the command
Artisan::command('logs:clear', function () {

    exec('rm ' . storage_path('logs/*.log'));
    $this->comment('Logs have been cleared!');

})->describe('Clear log files');
// command to clear Journal related information
Artisan::command('journal-entry:clear', function () {
    JournalEntry::truncate();
    JournalEntryDetail::truncate();
    AccountBalance::truncate();
    AccountTransactionHistory::truncate();
    CashBookEntry::truncate();
    $this->comment('Journal entry data has been cleared!');
})->describe('Clear Journal Entry Related Data');
// command to clear payslip related information
Artisan::command('payslip:clear', function () {
    Payslip::truncate();
    PayslipDetail::truncate();
    PayslipBatch::truncate();
    $this->comment('Payslip entry data has been cleared!');
})->describe('Clear Journal Entry Related Data');

// command to clear tms-journal-entry-data
Artisan::command('tms-journal-entry:clear', function () {
    TmsJournalEntry::truncate();
    TmsJournalEntryDetail::truncate();
    TmsCashBookEntry::truncate();
    TmsAccountBalance::truncate();
    $this->comment('Tms Journal Entry Data Has Been Cleared!');
})->describe('Clear Tms Journal Entry Related Data');

// command to clear hm-journal-entry-data
Artisan::command('hm-journal-entry:clear', function () {
    HmJournalEntry::truncate();
    HmJournalEntryDetail::truncate();
    hmCashBookEntry::truncate();
    hmAccountBalance::truncate();
    $this->comment('Hostel Journal Entry Data Has Been Cleared!');
})->describe('Clear Hostel Journal Entry Related Data');

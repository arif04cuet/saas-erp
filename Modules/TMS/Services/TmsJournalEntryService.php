<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Services\FiscalYearService;
use Modules\Accounts\Services\JournalEntryService;
use Modules\TMS\Entities\TmsBudget;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Entities\TmsJournalEntryDetail;
use Modules\TMS\Repositories\TmsJournalEntryRepository;
use Illuminate\Support\Facades\Session;

class TmsJournalEntryService
{
    use CrudTrait;

    /**
     * @var TmsJournalEntryDetailService
     */
    private $tmsJournalEntryDetailService;

    /**
     * @var TmsAdvancePaymentService
     */
    private $tmsAdvancePaymentService;
    /**
     * @var JournalEntryService
     */
    private $journalEntryService;
    /**
     * @var TmsCodeSettingService
     */
    private $tmsCodeSettingService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;


    /**
     * TmsJournalEntryService constructor.
     * @param TmsJournalEntryRepository $tmsJournalEntryRepository
     * @param TmsCodeSettingService $tmsCodeSettingService
     * @param TmsAdvancePaymentService $tmsAdvancePaymentService
     * @param JournalEntryService $journalEntryService
     * @param FiscalYearService $fiscalYearService
     * @param TmsJournalEntryDetailService $tmsJournalEntryDetailService
     */
    public function __construct(
        TmsJournalEntryRepository $tmsJournalEntryRepository,
        TmsCodeSettingService $tmsCodeSettingService,
        TmsAdvancePaymentService $tmsAdvancePaymentService,
        JournalEntryService $journalEntryService,
        FiscalYearService $fiscalYearService,
        TmsJournalEntryDetailService $tmsJournalEntryDetailService
    ) {
        $this->setActionRepository($tmsJournalEntryRepository);
        $this->tmsJournalEntryDetailService = $tmsJournalEntryDetailService;
        $this->journalEntryService = $journalEntryService;
        $this->tmsAdvancePaymentService = $tmsAdvancePaymentService;
        $this->fiscalYearService = $fiscalYearService;
        $this->tmsCodeSettingService = $tmsCodeSettingService;
    }

    public function getTransactionTypes()
    {
        return TmsJournalEntry::transactionTypes();
    }

    public function getPaymentTypes()
    {
        return TmsJournalEntry::paymentTypes();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $tmsjournalEntryData['date'] = $data['date'] ?
                Carbon::parse($data['date'])->format('Y-m-d') : Carbon::now()->format('Y-m-d');
            $this->checkFiscalYearValidation(Carbon::parse($data['date'])->format('Y-m-d'), $data['fiscal_year_id']);
            $tmsjournalEntryData['title'] = $data['title'] ?? '';
            $tmsjournalEntryData['training_id'] = $data['training_id'] ?? null;
            $tmsjournalEntryData['fiscal_year_id'] = $data['fiscal_year_id'] ?? null;
            // save journal entry
            $tmsjournalEntry = $this->save($tmsjournalEntryData);
            // save journal entry details
            $this->tmsJournalEntryDetailService->store($tmsjournalEntry, $data['tms_journal_entries'],
                $data['cash_book_entries']);
            // save advance entry if flagged
            $this->storeTmsAdvanceEntry($data, $tmsjournalEntry);
            // post journal entry to accounts module
            $this->postTmsJournalEntryToCentralAccounts($tmsjournalEntry, $data['cash_book_entries']['payment_type']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Tms Journal Entry Error: " . $e->getMessage() . " trace:" . $e->getTraceAsString());
            Session::flash('budget-exceed', $e->getMessage());
            return false;
        }
    }

    /**
     * @param array $data
     * @param TmsJournalEntry $tmsJournalEntry
     * @return bool
     */
    public function updateData(array $data, TmsJournalEntry $tmsJournalEntry)
    {
        try {
            DB::beginTransaction();
            $tmsjournalEntryData['date'] = $data['date'] ?
                Carbon::parse($data['date'])->format('Y-m-d') : Carbon::now()->format('Y-m-d');
            $this->checkFiscalYearValidation(Carbon::parse($data['date'])->format('Y-m-d'), $data['fiscal_year_id']);
            $tmsjournalEntryData['title'] = $data['title'] ?? '';
            $tmsjournalEntryData['training_id'] = $data['training_id'] ?? null;
            $tmsjournalEntryData['fiscal_year_id'] = $data['fiscal_year_id'] ?? null;
            // update journal entry
            $tmsjournalEntry = $this->update($tmsJournalEntry, $tmsjournalEntryData);
            // update new journal entry details
            $this->tmsJournalEntryDetailService->updateData($tmsjournalEntry, $data['tms_journal_entries'],
                $data['cash_book_entries']);
            // save advance entry if flagged
            $this->storeTmsAdvanceEntry($data, $tmsjournalEntry);
            // post journal entry to accounts module
            $this->postTmsJournalEntryToCentralAccounts($tmsjournalEntry, $data['cash_book_entries']['payment_type']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Tms Journal Entry Error: " . $e->getMessage() . " trace:" . $e->getTraceAsString());
            Session::flash('budget-exceed', $e->getMessage());
            return false;
        }

    }

    public function getEntriesWithTrainingAndSector(int $trainingId, int $subSectorId): array
    {
        $journalEntries = $this->findBy(['training_id' => $trainingId, 'status' => 'approved']);

        $journalEntriesWithSector = [];
        foreach ($journalEntries as $journalEntry) {
            $expense = $journalEntry->tmsJournalEntryDetails->reject(function ($item) use ($subSectorId) {
                return $item->tms_sub_sector_id !== $subSectorId;
            });
            if (count($expense)) {
                $journalEntriesWithSector[$journalEntry->title] = $expense->sum('debit_amount');
            }
        }

        return $journalEntriesWithSector;
    }

    public function getVatAndTaxInfoForSubSectors(int $trainingId, int $subSectorId)
    {

        $journalEntries = $this->findBy([
            'training_id' => $trainingId,
            'status' => 'approved'
        ]);
        $journalEntriesWithSector = [];
        $vatAndTaxArray = [];
        foreach ($journalEntries as $journalEntry) {
            $expense = $journalEntry->tmsJournalEntryDetails->reject(function ($item) use ($subSectorId) {
                return $item->tms_sub_sector_id !== $subSectorId;
            })->filter(function ($entry) {
                return !$entry->is_cash_book_entry;
            })->each(function ($entry) use (&$vatAndTaxArray) {
                $title = optional($entry->tmsJournalEntry)->title ?? trans('labels.not_found');
                $vatAndTaxArray[$title]['vat'] = optional($entry->tmsVatTaxDetail)->vat_amount ?? 0;
                $vatAndTaxArray[$title]['tax'] = optional($entry->tmsVatTaxDetail)->tax_amount ?? 0;
            });
        }
        return $vatAndTaxArray;
    }

    public function postTmsJournalEntryToCentralAccounts(TmsJournalEntry $tmsJournalEntry, $paymentType)
    {
        $budgetSource = $tmsJournalEntry->training->tmsBudget->budget_source ?? null;
        $orgBudgetSource = strtolower(TmsBudget::getBudgetSources()['organization']);
        if ($budgetSource == $orgBudgetSource || $budgetSource == null) {
            return;
        }
        $journalEntryData = $this->prepareAccountsJournalEntryData($tmsJournalEntry, $paymentType);
        $this->journalEntryService->postJournalEntry($journalEntryData);
    }

    /**
     * @param TmsJournalEntry $tmsJournalEntry
     */
    public function setOldJournalEntries(TmsJournalEntry $tmsJournalEntry)
    {
        // set general inputs
        session(['_old_input.training_id' => $tmsJournalEntry->training_id]);
        session(['_old_input.title' => $tmsJournalEntry->title]);
        session(['_old_input.fiscal_year_id' => $tmsJournalEntry->fiscal_year_id]);
        session(['_old_input.date' => $tmsJournalEntry->date]);
        // set journal entries and cash boook entries
        $oldResponses = [];
        $oldCashBookEntries = [];
        foreach ($tmsJournalEntry->tmsJournalEntryDetails as $tmsJournalEntryDetail) {
            if ($tmsJournalEntryDetail->is_cash_book_entry) {
                $data = [];
                $data['payment_type'] = optional($tmsJournalEntryDetail->tmsCashBookEntry)->payment_type;
                $data['transaction_type'] = $tmsJournalEntryDetail->transaction_type;
                $data['tms_sub_sector_id'] = $tmsJournalEntryDetail->tms_sub_sector_id;
                $data['debit_amount'] = $tmsJournalEntryDetail->debit_amount ?? null;
                $data['credit_amount'] = $tmsJournalEntryDetail->credit_amount ?? null;
                $oldCashBookEntries[] = $data;
            } else {
                $data = [];
                $data['remark'] = $tmsJournalEntryDetail->remark;
                $data['transaction_type'] = $tmsJournalEntryDetail->transaction_type;
                $data['tms_sub_sector_id'] = $tmsJournalEntryDetail->tms_sub_sector_id;
                $data['debit_amount'] = $tmsJournalEntryDetail->debit_amount;
                $data['credit_amount'] = $tmsJournalEntryDetail->credit_amount;
                $data['is_cash_book_entry'] = $tmsJournalEntryDetail->is_cash_book_entry;
                $data['vat_amount'] = optional($tmsJournalEntryDetail->tmsVatTaxDetail)->vat_amount ?? 0;
                $data['tax_amount'] = optional($tmsJournalEntryDetail->tmsVatTaxDetail)->vat_amount ?? 0;
                $data['employee_id'] = optional($tmsJournalEntryDetail)->employee_id ?? 0;
                $oldResponses[] = $data;
            }
        }
        session(['_old_input.tms_journal_entries' => $oldResponses]);
        session(['_old_input.cash_book_entries' => $oldCashBookEntries]);
    }

    public function resetOldJournalEntriesFromSession()
    {
        if (session()->has('_old_input.tms_journal_entries')) {
            session()->forget('_old_input.tms_journal_entries');
        }
        if (session()->has('_old_input.cash_book_entries')) {
            session()->forget('_old_input.cash_book_entries');
        }
        if (session()->has('_old_input.training_id')) {
            session()->forget('_old_input.training_id');
        }
        if (session()->has('_old_input.title')) {
            session()->forget('_old_input.title');
        }
        if (session()->has('_old_input.fiscal_year_id')) {
            session()->forget('_old_input.fiscal_year_id');
        }
        if (session()->has('_old_input.date')) {
            session()->forget('_old_input.date');
        }
    }

    /**
     * @param TmsJournalEntry $tmsJournalEntry
     * @param $status
     * @return false|TmsJournalEntry
     */
    public function changeStatus(TmsJournalEntry $tmsJournalEntry, $status)
    {
        try {
            DB::beginTransaction();
            // update tms status
            $this->update($tmsJournalEntry, ['status' => $status]);
            // update all the details
            $tmsJournalEntry->tmsJournalEntryDetails()->update(['status' => $status]);
            DB::commit();
            return $tmsJournalEntry;
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * |----------------------------------------------------------------------------------------------------------------
     * |                                             Private Methods
     * |----------------------------------------------------------------------------------------------------------------
     * |
     */

    /**
     * @param array $data
     * @param Model $tmsjournalEntry
     * @throws Exception
     */
    private function storeTmsAdvanceEntry(array $data, Model $tmsjournalEntry): void
    {
        if (isset($data['is_advance_payment'])) {
            if (!isset($data['employee_id'])) {
                throw new Exception('An Employee Should Be Selected');
            }
            $advanceEntryOption = $data['advance_entry'];
            $this->tmsAdvancePaymentService->saveData($tmsjournalEntry, $advanceEntryOption,
                $data['employee_id']);
        }
    }

    private function prepareAccountsJournalEntryData(TmsJournalEntry $tmsJournalEntry, $paymentType)
    {
        $masterArray = [];
        $journalEntryArray = [];
        $journalEntryDetailArray = [];
        //create journal entry meta data  array
        $journalEntryArray['date'] = $tmsJournalEntry->date;
        $journalEntryArray['reference'] = $tmsJournalEntry->title;
        $journalEntryArray['fiscal_year_id'] = $tmsJournalEntry->fiscal_year_id;
        // for each entry, create journal entry detail array
        foreach ($tmsJournalEntry->tmsJournalEntryDetails as $tmsJournalEntryDetail) {
            $tempArray = [];
            $tmsCodeSetting = $this->tmsCodeSettingService->getCodeSettingBySubSectorId($tmsJournalEntryDetail->tms_sub_sector_id);
            if (is_null($tmsCodeSetting)) {
                Session::flash('code_setting_not_found',
                    trans('tms::tms_journal_entry.flash_messages.code_setting_not_found',
                        ['sector' => $tmsJournalEntryDetail->tmsSubSector->getTitle()])
                );
                throw new Exception(trans('tms::tms_journal_entry.flash_messages.code_setting_not_found',
                    ['sector' => $tmsJournalEntryDetail->tmsSubSector->getTitle()]));
            }
            // $journalEntryArray['journal_id'] = $tmsCodeSetting->journal_id;
            if (!$tmsCodeSetting) {
                continue;
            }
            $tempArray['economy_code'] = $tmsCodeSetting->economy_code ?? null;
            $tempArray['credit_amount'] = $tmsJournalEntryDetail->credit_amount ?? 0;
            $tempArray['debit_amount'] = $tmsJournalEntryDetail->debit_amount ?? 0;
            $tempArray['source'] = JournalEntryDetail::getSources()[1]; // revenue
            $tempArray['account_transaction_type'] = $this->getTransactionTypeForCentralAccount($tmsJournalEntryDetail);// payment
            $tempArray['remark'] = $tmsJournalEntryDetail->remark ?? '';
            $tempArray['is_cash_book_entry'] = $tmsJournalEntryDetail->is_cash_book_entry;
            $journalEntryDetailArray[] = $tempArray;
        }
        $masterArray['journal_entry_meta_data'] = $journalEntryArray;
        $masterArray['journal_entry_details'] = $journalEntryDetailArray;
        $masterArray['payment_type'] = $paymentType;
        return $masterArray;
    }

    private function getTransactionTypeForCentralAccount(TmsJournalEntryDetail $tmsJournalEntryDetail)
    {
        $tmsTransctionTypes = array_keys(TmsJournalEntryDetail::getTransactionTypes());
        $accountsTransctionTypes = array_keys(JournalEntry::getTransactionTypes());
        if ($tmsJournalEntryDetail->transaction_type == $tmsTransctionTypes[0]) {
            // its receipt in accounts module, receive in tms module
            return $accountsTransctionTypes[0];
        }
        return $tmsJournalEntryDetail->transaction_type;
    }

    private function checkFiscalYearValidation($date, $fiscalYearId)
    {
        $fiscalYear = $this->fiscalYearService->getFiscalYearByDate($date);
        if ($fiscalYear->id != $fiscalYearId) {
            $message = 'Please select a date within ' . $fiscalYear->name . " Fiscal Year";
            Session::flash('budget-exceed', $message);
            Log::error($message);
            throw new Exception($message);
        }

    }
}


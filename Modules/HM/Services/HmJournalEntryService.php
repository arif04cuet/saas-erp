<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\FiscalYear;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\HM\Entities\HmJournalEntry;
use Modules\HM\Entities\HmJournalEntryDetail;
use Modules\HM\Repositories\HmJournalEntryRepository;
use Modules\TMS\Entities\TmsJournalEntry;

class HmJournalEntryService
{
    use CrudTrait;

    /**
     * @var HostelBudgetTitleService
     */
    private $hostelBudgetTitleService;

    /**
     * @var HmJournalEntryDetailService
     */
    private $hmJournalEntryDetailService;

    /**
     * HmJournalEntryService constructor.
     * @param HmJournalEntryRepository $hmJournalEntryRepository
     * @param HmJournalEntryDetailService $hmJournalEntryDetailService
     * @param HostelBudgetTitleService $hostelBudgetTitleService
     */
    public function __construct(
        HmJournalEntryRepository $hmJournalEntryRepository,
        HmJournalEntryDetailService $hmJournalEntryDetailService,
        HostelBudgetTitleService $hostelBudgetTitleService
    ) {
        $this->setActionRepository($hmJournalEntryRepository);
        $this->hostelBudgetTitleService = $hostelBudgetTitleService;
        $this->hmJournalEntryDetailService = $hmJournalEntryDetailService;
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
            $hmJournalEntryData['date'] = $data['date'] ?? Carbon::now()->format('Y-m-d');
            $hmJournalEntryData['journal_id'] = $data['journal_id'] ?? null;
            $hmJournalEntryData['title'] = $data['title'] ?? '';
            $fiscalYear = $this->hostelBudgetTitleService
                ->getFiscalYearFromHostelBudgetTitle($data['hostel_budget_title_id']);
            $hmJournalEntryData['fiscal_year_id'] = $fiscalYear->id ?? null;
            $hmJournalEntryData['hostel_budget_title_id'] = $data['hostel_budget_title_id'];
            // save journal entry
            $hmJournalEntry = $this->save($hmJournalEntryData);
            // save journal entry details
            $this->hmJournalEntryDetailService->store($hmJournalEntry, $data['hm_journal_entries'],
                $data['cash_book_entries']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Hm Journal Entry Error: " . $e->getMessage() . " trace:" . $e->getTraceAsString());
            if (Session::has('budget-exceed')) {
                Session::flash('error', $e->getMessage());
            } else {
                Session::flash('error', trans('labels.generic_error_message'));
            }
            return false;
        }
    }

    /**
     * @param bool $yearly
     * @param bool $monthly
     * @param array $params ['fiscal_year'=>'','month'=>'']
     * @return Collection
     * @throws \Exception
     */
    public function getIncomeExpenseData(bool $yearly = true, bool $monthly = false, array $params)
    {
        $incomeExpenseData = collect();
        if (!isset($params['fiscal_year']) || is_null($params['fiscal_year'])) {
            throw new \Exception('Budget Report Error: A Fiscal Year Must Be Selected! ');
        }

        if ($yearly && $monthly) {
            if (!isset($params['month']) || is_null($params['month'])) {
                throw new \Exception('Budget Report Error: A Month Must Be Selected! ');
            }
            //todo:: write the query
            return $incomeExpenseData;
        } elseif ($yearly && !$monthly) {
            $fiscalYear = $params['fiscal_year'];
            $journalEntriesByYear = $this->actionRepository->getJournalEntriesWithDetails($fiscalYear->id);
            $incomeExpenseData = $this->prepareIncomeExpenseDataFromJournalEntries($journalEntriesByYear);
            return $incomeExpenseData;
        } else {
            return $incomeExpenseData;
        }
    }

    public function storeIntegratedJournalEntry(array $data)
    {
        try {
            DB::beginTransaction();
            $hmJournalEntryData['date'] = $data['date'] ?? Carbon::now()->format('Y-m-d');
            $hmJournalEntryData['journal_id'] = $data['journal_id'] ?? null;
            $hmJournalEntryData['title'] = $data['title'] ?? '';
            $fiscalYear = $this->hostelBudgetTitleService
                ->getFiscalYearFromHostelBudgetTitle($data['hostel_budget_title_id']);
            $hmJournalEntryData['fiscal_year_id'] = $fiscalYear->id ?? null;
            $hmJournalEntryData['hostel_budget_title_id'] = $data['hostel_budget_title_id'];
            // save journal entry
            $hmJournalEntry = $this->save($hmJournalEntryData);
            // save journal entry details
            $this->hmJournalEntryDetailService->storeSingleJournalEntryDetail($hmJournalEntry,
                $data['hm_journal_entries']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Tms Journal Entry Error: " . $e->getMessage() . " trace:" . $e->getTraceAsString());
            Session::flash('budget-exceed', $e->getMessage());
            return false;
        }

    }

    public function getHostelBudgetTitleFromDate(Carbon $date)
    {
        return $this->hostelBudgetTitleService->getHostelBudgetTitleFromDate($date);
    }
    //----------------------------------------------------------------------------------------------
    //                                        Private Methods
    //-----------------------------------------------------------------------------------------------
    /**
     * @param Collection $journalEntries
     * @return Collection
     */
    private function prepareIncomeExpenseDataFromJournalEntries(Collection $journalEntries)
    {
        $transactionTypes = HmJournalEntry::transactionTypes(true);
        $incomeExpenseData = collect();
        $sectionIncomeData = collect();
        $sectionExpenseData = collect();
        foreach ($journalEntries as $journalEntry) {
            foreach ($journalEntry->hmJournalEntryDetails as $journalEntryDetail) {
                if ($journalEntryDetail->transaction_type == $transactionTypes[0]) {
                    // income data
                    if (!isset($sectionIncomeData[$journalEntryDetail->hostel_budget_section_id])) {
                        $sectionIncomeData[$journalEntryDetail->hostel_budget_section_id] = $this->getTransactionAmount($journalEntryDetail);
                    } else {
                        try {
                            $sectionIncomeData[$journalEntryDetail->hostel_budget_section_id] += $this->getTransactionAmount($journalEntryDetail);
                        } catch (\Exception $e) {
                            dump($this->getTransactionAmount($journalEntryDetail));
                            dd();
                        }
                    }
                } else {
                    //expense data
                    if (!isset($sectionExpenseData[$journalEntryDetail->hostel_budget_section_id])) {
                        $sectionExpenseData[$journalEntryDetail->hostel_budget_section_id] = $this->getTransactionAmount($journalEntryDetail);
                    } else {
                        $sectionExpenseData[$journalEntryDetail->hostel_budget_section_id] += $this->getTransactionAmount($journalEntryDetail);
                    }
                }
            }
        }
        // format the data

        $incomeExpenseData['income'] = $sectionIncomeData;
        $incomeExpenseData['expense'] = $sectionExpenseData;
        return $incomeExpenseData;
    }

    private function getTransactionAmount(HmJournalEntryDetail $journalEntryDetail)
    {
        $transactionTypes = HmJournalEntry::transactionTypes(true);
        $amount = 0;
        if ($journalEntryDetail->is_cash_book_entry) {
            if ($journalEntryDetail->transaction_type == $transactionTypes[0]) {
                $amount = $journalEntryDetail->debit_amount ?? 0;   // receive
            } else {
                $amount = $journalEntryDetail->credit_amount ?? 0;
            }
        } else {
            if ($journalEntryDetail->transaction_type == $transactionTypes[0]) {
                $amount = $journalEntryDetail->credit_amount ?? 0;   // receive
            } else {
                $amount = $journalEntryDetail->debit_amount ?? 0;
            }
        }
        return $amount;
    }
}


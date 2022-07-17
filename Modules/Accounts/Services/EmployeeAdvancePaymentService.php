<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\EmployeeAdvancePayment;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Repositories\EmployeeAdvancePaymentRepository;

class EmployeeAdvancePaymentService
{
    use CrudTrait;

    public function __construct(EmployeeAdvancePaymentRepository $employeeAdvancePaymentRepository)
    {
        $this->setActionRepository($employeeAdvancePaymentRepository);
    }

    /**
     * @param JournalEntry $journalEntry
     * @param string $advanceEntry
     * @param string $employee_id
     * @return Model
     */
    public function saveData(JournalEntry $journalEntry, string $advanceEntry, string $employee_id)
    {
        $data = $this->prepareDataFromJournalEntry($journalEntry);
        $data['employee_id'] = $employee_id;
        if ($advanceEntry == 'advance_adjustment') {
            // ignore the debit amounts
            $data['total_debit_amount'] = 0;
        } else {
            // ignore the debit amounts
            $data['total_credit_amount'] = 0;
        }
        return $this->save($data);
    }

    public function getEmployeeAdvancePaymentsSummary()
    {
        $summary = $this->actionRepository->getSummary();
        return $summary;

    }

    public function getDataByEmployee($id)
    {
        $employeeAdvancePayment = $this->findOne($id);
        return $this->actionRepository->getModel()->where('employee_id', $employeeAdvancePayment->employee_id)->get();

    }

    private function prepareDataFromJournalEntry(
        JournalEntry $journalEntry
    ) {
        $totalDebitAmount = 0;
        $totalCreditAmount = 0;
        foreach ($journalEntry->journalEntryDetails as $journalEntryDetail) {
            if (!$journalEntryDetail->is_cash_book_entry) {
                $totalDebitAmount += $journalEntryDetail->debit_amount;
                $totalCreditAmount += $journalEntryDetail->credit_amount;
            }
        }
        return [
            'journal_entry_id' => $journalEntry->id,
            'date' => $journalEntry->date,
            'total_debit_amount' => $totalDebitAmount,
            'total_credit_amount' => $totalCreditAmount,
            'status' => array_keys(EmployeeAdvancePayment::getStatuses())[0] // draft
        ];
    }

}


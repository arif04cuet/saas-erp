<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\EmployeeAdvancePayment;
use Modules\Accounts\Entities\JournalEntry;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Repositories\TmsAdvancePaymentRepository;

class TmsAdvancePaymentService
{
    use CrudTrait;

    public function __construct(TmsAdvancePaymentRepository $tmsAdvancePaymentRepository)
    {
        $this->setActionRepository($tmsAdvancePaymentRepository);
    }

    /**
     * @param TmsJournalEntry $tmsJournalEntry
     * @param string $advanceEntryOption
     * @param string $employee_id
     * @return Model
     */
    public function saveData(TmsJournalEntry $tmsJournalEntry, string $advanceEntryOption, string $employee_id)
    {
        $data = $this->prepareDataForTmsJournalEntry($tmsJournalEntry);
        $data['employee_id'] = $employee_id;
        if ($advanceEntryOption == 'advance_adjustment') {
            // ignore the debit amounts
            $data['total_debit_amount'] = 0;
        } else {
            // ignore the debit amounts
            $data['total_credit_amount'] = 0;
        }
        return $this->save($data);
    }

    private function prepareDataForTmsJournalEntry(TmsJournalEntry $tmsJournalEntry)
    {
        $totalDebitAmount = 0;
        $totalCreditAmount = 0;
        foreach ($tmsJournalEntry->tmsJournalEntryDetails as $tmsJournalEntryDetail) {
            if (!$tmsJournalEntryDetail->is_cash_book_entry) {
                $totalDebitAmount += $tmsJournalEntryDetail->debit_amount;
                $totalCreditAmount += $tmsJournalEntryDetail->credit_amount;
            }
        }
        return [
            'tms_journal_entry_id' => $tmsJournalEntry->id,
            'training_id' => $tmsJournalEntry->training_id,
            'date' => $tmsJournalEntry->date,
            'total_debit_amount' => $totalDebitAmount,
            'total_credit_amount' => $totalCreditAmount,
            'status' => 'draft'
        ];

    }

    /**
     * @return mixed
     */
    public function getEmployeeAdvancePaymentsSummary()
    {
        return $this->actionRepository->getSummary();

    }

    public function getDataByEmployee($id)
    {
        $tmsAdvancePayments = $this->findOne($id);
        return $this->actionRepository->getModel()->where('employee_id', $tmsAdvancePayments->employee_id)->get();
    }


}


<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Entities\TmsJournalEntryDetail;
use Modules\TMS\Repositories\TmsVatTaxDetailRepository;

class TmsVatTaxDetailService
{
    use CrudTrait;

    public function __construct(TmsVatTaxDetailRepository $tmsVatTaxDetailRepository)
    {
        $this->setActionRepository($tmsVatTaxDetailRepository);
    }

    public function createOrUpdate(
        TmsJournalEntry $tmsJournalEntry,
        TmsJournalEntryDetail $tmsJournalEntryDetail,
        array $tmsJournalEntryDetailData
    ) {
        $data = $this->getTmsVatTaxDetailData($tmsJournalEntry, $tmsJournalEntryDetail, $tmsJournalEntryDetailData);
        return $this->actionRepository->createOrUpdate($data);
    }

    /**
     * |------------------------------------------------------------------------------------------------------------------
     * |                                              Private Methods
     * |------------------------------------------------------------------------------------------------------------------
     * |
     * @param TmsJournalEntry $tmsJournalEntry
     * @param TmsJournalEntryDetail $tmsJournalEntryDetail
     * @param array $data
     * @return array
     */

    private function getTmsVatTaxDetailData(
        TmsJournalEntry $tmsJournalEntry,
        TmsJournalEntryDetail $tmsJournalEntryDetail,
        array $data
    ): array {
        $vatAmount = isset($data['vat_amount']) ? $data['vat_amount'] : 0.0;
        $taxAmount = isset($data['tax_amount']) ? $data['tax_amount'] : 0.0;
        $training = $tmsJournalEntry->training ?? null;
        if (is_null($training)) {
            throw new \Exception('Training Not Found ! Please Select A Training ');
        }
        return [
            'training_id' => $tmsJournalEntry->id,
            'tms_journal_entry_detail_id' => $tmsJournalEntryDetail->id,
            'vat_amount' => $vatAmount,
            'tax_amount' => $taxAmount
        ];
    }
}


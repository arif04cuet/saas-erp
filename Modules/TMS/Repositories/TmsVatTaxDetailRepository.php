<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TmsVatTaxDetail;

class TmsVatTaxDetailRepository extends AbstractBaseRepository
{

    protected $modelName = TmsVatTaxDetail::class;

    public function createOrUpdate(array $data)
    {
        $this->getModel()->newQuery()->updateOrCreate(
            ['tms_journal_entry_detail_id' => $data['tms_journal_entry_detail_id']],
            $data
        );
    }

}

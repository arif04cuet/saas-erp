<?php


namespace Modules\MMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\MMS\Entities\MedicineDistributionHistory;

class MedicineDistributionHistoryRepository extends AbstractBaseRepository
{
    protected $modelName = MedicineDistributionHistory::class;
}

<?php


namespace Modules\MMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\MMS\Entities\MedicineDistribution;

class MedicineDistributionRepository extends AbstractBaseRepository
{

    protected $modelName = MedicineDistribution::class;
}

<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\AnnualTrainingNotificationOrganization;

class AnnualTrainingNotificationOrganizationRepository extends AbstractBaseRepository
{
    protected $modelName = AnnualTrainingNotificationOrganization::class;

    public function getOrganizationByUniqueKey($uniqueKey)
    {
        return $this->findBy(['unique_key' => $uniqueKey])->first();
    }
}

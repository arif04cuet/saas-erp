<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use Modules\HM\Repositories\CheckinTraineeRepository;
use Modules\TMS\Entities\Training;

class CheckinTraineeService
{
    use CrudTrait;

    public function __construct(CheckinTraineeRepository $checkinTraineeRepository)
    {
        $this->setActionRepository($checkinTraineeRepository);
    }

    public function getCheckedInTrainees(Training $training)
    {
        return $this->actionRepository->getCheckedInTrainees($training->id);
    }


}


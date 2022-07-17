<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\RegisteredTraineeEducation;
use Modules\TMS\Entities\RegisteredTraineeGeneralInfo;
use Modules\TMS\Repositories\TraineeEducationInfoRepository;
use Modules\TMS\Entities\Trainee;

class TraineeEducationInfoService
{
    use CrudTrait;
    /**
     * @var TraineeEducationInfoRepository
     */
    private $traineeEducationInfoRepository;

    public function __construct(TraineeEducationInfoRepository $traineeEducationInfoRepository)
    {
        /** @var TraineeEducationInfoRepository $traineeEducationInfoRepository */
        $this->traineeEducationInfoRepository = $traineeEducationInfoRepository;
        $this->setActionRepository($traineeEducationInfoRepository);
    }

    public function storeEducationInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            $educationInfo = new RegisteredTraineeEducation($data);
            return $trainee->educations()->save($educationInfo);
        });
    }

    public function updateEducationInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            return $trainee->educations->update($data);
        });
    }
}

<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\RegisteredTraineeGeneralInfo;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Repositories\TraineeGeneralInfoRepository;

class TraineeGeneralInfoService
{
    use CrudTrait;
    /**
     * @var TraineeGeneralInfoRepository
     */
    private $traineeGeneralInfoRepository;

    public function __construct(TraineeGeneralInfoRepository $traineeGeneralInfoRepository)
    {
        /** @var TraineeGeneralInfoRepository $traineeGeneralInfoRepository */
        $this->traineeGeneralInfoRepository = $traineeGeneralInfoRepository;
        $this->setActionRepository($traineeGeneralInfoRepository);
    }

    public function storeGeneralInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            $traineeGeneralInfo = new RegisteredTraineeGeneralInfo($data);
            return $trainee->generalInfos()->save($traineeGeneralInfo);
        });
    }

    public function updateGeneralInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            return $trainee->generalInfos->update($data);
        });
    }
}

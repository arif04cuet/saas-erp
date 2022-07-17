<?php
namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\RegisteredTraineeGeneralInfo;
use Modules\TMS\Entities\RegisteredTraineeServiceInfo;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Repositories\TraineeServiceInfoRepository;

class TraineeServiceInfoService
{
    use CrudTrait;

    /**
     * @var TraineeServiceInfoRepository
     */
    private $traineeServiceInfoRepository;

    public function __construct(TraineeServiceInfoRepository $traineeServiceInfoRepository)
    {
        /** @var TraineeServiceInfoRepository $traineeServiceInfoRepository */
        $this->traineeServiceInfoRepository = $traineeServiceInfoRepository;
        $this->setActionRepository($traineeServiceInfoRepository);
    }

    public function storeServiceInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){

            if (array_key_exists('joining_date', $data)) {
                $data['joining_date'] = Carbon::createFromFormat('d/m/Y', $data['joining_date']);
            }

            $service = new RegisteredTraineeServiceInfo($data);
            return $trainee->services()->save($service);
        });
    }

    public function updateServiceInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){

            if (array_key_exists('joining_date', $data)) {
                $data['joining_date'] = Carbon::createFromFormat('d/m/Y', $data['joining_date']);
            }

            return $trainee->services->update($data);
        });
    }
}

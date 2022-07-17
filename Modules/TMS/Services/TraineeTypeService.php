<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Modules\TMS\Entities\Trainee;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Repositories\TraineeTypeRepository;
use Modules\TMS\Entities\TraineeType;

class TraineeTypeService
{

    use CrudTrait;
    /**
     * @var TraineeTypeRepository
     */
    private $traineeTypeRepository;

    public function __construct(TraineeTypeRepository $traineeTypeRepository)
    {
        /** @var TraineeTypeRepository $traineeTypeRepository */
        $this->traineeTypeRepository = $traineeTypeRepository;
        $this->setActionRepository($traineeTypeRepository);
    }

    public function storeTraineeTypeInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            // dd($data);
            $traineeTypeInfo = new TraineeType($data);
            // dd($traineeTypeInfo);
            // dd($trainee);
            return $trainee->traineeType()->save($traineeTypeInfo);
        });
    }

    public function updateTraineeTypeInfo(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            // dd($data);
            return $trainee->traineeType->update($data);
        });
    }

}


<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCostSegmentation;
use Modules\TMS\Repositories\TrainingCostSegmentationRepository;

class TrainingCostSegmentationService
{

    use CrudTrait;

    /**
     * @var TrainingCostSegmentationRepository
     */
    private $repository;

    /**
     * TrainingCourseAdministrationService constructor.
     * @param TrainingCostSegmentationRepository $repository
     */
    public function __construct(TrainingCostSegmentationRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function update(Training $training, $data)
    {
        return DB::transaction(function () use ($data, $training) {
            $delete = $training->trainingCostSegmentation()->delete();
            if (!empty($data)) {
                // $total_cost = $data['total_cost'];
                // $data['total_cost'] = $total_cost;
                return $training->trainingCostSegmentation()->createMany($data);
            }
            return $delete;
        });
    }

    public function formattedDropdown()
    {
         return $this->repository->findAll()
            ->mapWithKeys(function ($type) {
                return [$type->id => trans('tms::mark_allotment_type.' . $type->title)];
            });
    }

}


<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Repositories\TrainingCourseSessionsEvaluationTraineeWarningEmailRecipientRepository;

class TrainingCourseSessionsEvaluationTraineeWarningEmailRecipientService
{

    use CrudTrait;

    private $repository;

    public function __construct(
        TrainingCourseSessionsEvaluationTraineeWarningEmailRecipientRepository $repository
    )
    {
        $this->repository = $repository;

        $this->setActionRepository($this->repository);
    }

    public function updateOrStore($data)
    {
        $model = $this->repository->getModel();

        return DB::transaction(function () use ($data, $model) {
            return $model->updateOrCreate(
                $data,
                $data
            );
        });
    }
}

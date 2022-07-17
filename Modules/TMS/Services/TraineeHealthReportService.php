<?php

namespace Modules\TMS\Services;

use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Repositories\TraineeHealthReportRepository;
use Modules\TMS\Entities\RegisteredTraineeHealthExam;
class TraineeHealthReportService
{
    /**
     * @var TraineeHealthReportRepository
     */
    private $traineeHealthReportRepository;

    public function __construct(TraineeHealthReportRepository $traineeHealthReportRepository)
    {
        /** @var TraineeHealthReportRepository $traineeHealthReportRepository */
        $this->traineeHealthReportRepository = $traineeHealthReportRepository;
    }

    public function updateHealthReport(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            return $trainee->healthExaminations()->updateOrCreate(['trainee_id' => $trainee->id], $data);
        });
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 12/24/18
 * Time: 7:00 PM
 */

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingHead;
use Modules\TMS\Entities\TrainingParticipant;
use Modules\TMS\Entities\TrainingSponsor;

class TrainingRepository extends AbstractBaseRepository
{
    protected $modelName = Training::class;

    public function getTrainingsBasedOnDate(Carbon $date)
    {
        list($startDate, $endDate) = $this->getFiscalYearDates($date);

        return $this->getModel()
            ->whereDate('start_date', '>=', $startDate)
            ->whereDate('end_date', '<=', $endDate)
            ->get();
    }

    public function getTotelRegisteredTraineeNumber($training)
    {
        return $training->trainee()->count();
    }

    /**
     * @param Carbon $date
     * @return array
     */
    private function getFiscalYearDates(Carbon $date): array
    {
        $crossOverDate = Carbon::createFromFormat('d-M', '01-Jul');

        if ($date->greaterThanOrEqualTo($crossOverDate)) {
            $startDate = Carbon::createFromFormat('d-M-Y', "01-Jul-{$date->format('Y')}");
            $endDate = Carbon::createFromFormat('d-M-Y', "30-Jun-{$date->addYear()->format('Y')}");
        } else {
            $endDate = Carbon::createFromFormat('d-M-Y', "30-Jun-{$date->format('Y')}");
            $startDate = Carbon::createFromFormat('d-M-Y', "01-Jul-{$date->subYear()->format('Y')}");
        }

        return [$startDate, $endDate];
    }

    public function updateTrainingParticipants(array $data, TrainingHead $trainingHead)
    {
        return TrainingParticipant::query()->whereTrainingHeadId($trainingHead->id)->update($data);
    }

    public function updateTrainingSponsors(array $data, TrainingHead $trainingHead)
    {
        return TrainingSponsor::query()->whereTrainingHeadId($trainingHead->id)->update($data);
    }

    public function getTrainingHeadsForDropdown()
    {
        $trainingHeads = TrainingHead::all();
        return $trainingHeads->each(function ($heads) {
            $name = app()->isLocale('bn') ? $heads->title_bangla : $heads->title_english;
            $heads->name = $name;
        })->pluck('name', 'id');
    }

}

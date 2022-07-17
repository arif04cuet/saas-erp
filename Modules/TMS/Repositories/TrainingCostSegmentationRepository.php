<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCostSegmentation;

class TrainingCostSegmentationRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCostSegmentation::class; // we are using the existing table

}

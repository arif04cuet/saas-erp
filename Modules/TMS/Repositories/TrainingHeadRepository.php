<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingHead;
use Modules\TMS\Services\TrainingHeadService;

class TrainingHeadRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingHead::class;

}

<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\VMS\Entities\TripLimit;

class TripLimitRepository extends AbstractBaseRepository
{
    protected $modelName = TripLimit::class;

}

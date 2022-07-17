<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\VMS\Entities\TripCalculationSetting;

class TripCalculationSettingRepository extends AbstractBaseRepository
{
    protected $modelName = TripCalculationSetting::class;

}

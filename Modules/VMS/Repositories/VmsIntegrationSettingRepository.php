<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\VMS\Entities\VmsIntegrationSetting;

class VmsIntegrationSettingRepository extends AbstractBaseRepository
{
    protected $modelName = VmsIntegrationSetting::class;


}

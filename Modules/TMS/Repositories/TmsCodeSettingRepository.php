<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TmsCodeSetting;

class TmsCodeSettingRepository extends AbstractBaseRepository
{

    protected $modelName = TmsCodeSetting::class;

    public function getSettingByEconomyCode($economyCode)
    {
        return $this->model->newQuery()
            ->whereEconomyCode($economyCode)
            ->first();
    }


}

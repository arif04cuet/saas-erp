<?php


namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\PmsCodeSetting;

class PmsCodeSettingRepository extends AbstractBaseRepository
{
    protected $modelName = PmsCodeSetting::class;

    public function getSettingByEconomyCode($economyCode)
    {
        return $this->model->newQuery()
            ->whereEconomyCode($economyCode)
            ->first();
    }
}

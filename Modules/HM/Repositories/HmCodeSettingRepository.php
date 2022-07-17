<?php


namespace Modules\HM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\HmCodeSetting;

class HmCodeSettingRepository extends AbstractBaseRepository
{

    protected $modelName = HmCodeSetting::class;


    public function getSettingByEconomyCode($economyCode)
    {
        return $this->model->newQuery()
            ->whereEconomyCode($economyCode)
            ->first();
    }


}

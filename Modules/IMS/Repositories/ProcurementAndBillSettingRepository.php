<?php


namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\ProcurementAndBillSetting;

class ProcurementAndBillSettingRepository extends AbstractBaseRepository {

    protected $modelName = ProcurementAndBillSetting::class;

    public function revokeDefaultSettings()
    {
        return $this->model->where('is_default', 1)->update(['is_default' => 0]);
    }
}

<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TmsCodeSetting;
use Modules\TMS\Repositories\TmsCodeSettingDetailRepository;

class TmsCodeSettingDetailService
{
    use CrudTrait;

    public function __construct(TmsCodeSettingDetailRepository $tmsCodeSettingDetailRepository)
    {
        $this->setActionRepository($tmsCodeSettingDetailRepository);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $datum) {
                $this->save($datum);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Tms Code Setting Detail Error" . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function deleteAllData()
    {
        return $this->actionRepository->getModel()::truncate();
    }
}


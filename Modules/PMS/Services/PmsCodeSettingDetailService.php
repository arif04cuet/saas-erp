<?php

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\PMS\Repositories\PmsCodeSettingDetailRepository;

class PmsCodeSettingDetailService
{
    use CrudTrait;

    private $pmsCodeSettingDetailRepository;


    public function __construct(PmsCodeSettingDetailRepository $pmsCodeSettingDetailRepository)
    {
        $this->setActionRepository($pmsCodeSettingDetailRepository);
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
            Log::error("Pms Code Setting Detail Error" . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function deleteAllData()
    {
        return $this->actionRepository->getModel()::truncate();
    }
}

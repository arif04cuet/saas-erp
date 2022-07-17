<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\HM\Entities\HmCodeSettingDetail;
use Modules\HM\Repositories\HmCodeSettingDetailRepository;

class HmCodeSettingDetailService
{
    use CrudTrait;

    public function __construct(HmCodeSettingDetailRepository $hmCodeSettingDetailRepository)
    {
        $this->setActionRepository($hmCodeSettingDetailRepository);
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
            Log::error("Hm Code Setting Detail Error" . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function deleteAllData()
    {
        return $this->actionRepository->getModel()::truncate();
    }

}


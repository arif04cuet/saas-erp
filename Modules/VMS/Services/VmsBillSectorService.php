<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\VMS\Entities\VmsBillSector;
use Modules\VMS\Entities\VmsBillSectorAssign;
use Modules\VMS\Repositories\VmsBillSectorRepository;

class VmsBillSectorService
{
    use CrudTrait;

    public function __construct(VmsBillSectorRepository $vmsBillSectorRepository)
    {
        $this->setActionRepository($vmsBillSectorRepository);
    }

    public function setOldSessionValues(VmsBillSector $vmsBillSector)
    {
        session(['_old_input.title_english' => $vmsBillSector->title_english]);
        session(['_old_input.title_bangla' => $vmsBillSector->title_bangla]);
        session(['_old_input.amount' => $vmsBillSector->amount]);
    }

    public function clearOldSessionValues()
    {
        if (session()->has('_old_input.title_english')) {
            session()->forget('_old_input.title_english');
        }
        if (session()->has('_old_input.title_bangla')) {
            session()->forget('_old_input.title_bangla');
        }
        if (session()->has('_old_input.amount')) {
            session()->forget('_old_input.amount');
        }
    }

    public function updateData(VmsBillSector $vmsBillSector, array $data)
    {
        try {
            DB::beginTransaction();
            $vmsBillSector->vmsBillSectorAssigns()->delete();
            foreach ($data['employees'] as $employee) {
                if (!isset($employee['selected'])) {
                    continue;
                }
                $vmsBillSector->vmsBillSectorAssigns()->save(new VmsBillSectorAssign([
                    'employee_id' => $employee['employee_id']
                ]));
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Vms Bill Sector Assign Error: ' . $exception->getMessage());
        }
    }

}


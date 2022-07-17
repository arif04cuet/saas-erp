<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Entities\VmsIntegrationSetting;
use Modules\VMS\Repositories\VmsIntegrationSettingRepository;

class VmsIntegrationSettingService
{
    use CrudTrait;

    public function __construct(VmsIntegrationSettingRepository $vmsIntegrationSettingRepository)
    {
        $this->setActionRepository($vmsIntegrationSettingRepository);
    }

    public function setSessionValues(VmsIntegrationSetting $vmsIntegrationSetting)
    {
        session(['_old_input.salary_rule_id' => $vmsIntegrationSetting->salary_rule_id ?? null]);
        session(['_old_input.tms_sub_sector_id' => $vmsIntegrationSetting->tms_sub_sector_id ?? null]);
        session(['_old_input.fuel_bill_economy_code' => $vmsIntegrationSetting->fuel_bill_economy_code ?? null]);
        session(['_old_input.vehicle_maintenance_economy_code' => $vmsIntegrationSetting->vehicle_maintenance_economy_code ?? null]);
        session(['_old_input.project_economy_code' => $vmsIntegrationSetting->project_economy_code ?? null]);
        session(['_old_input.accounts_bank_cash_economy_code' => $vmsIntegrationSetting->accounts_bank_cash_economy_code ?? null]);
        session(['_old_input.tms_bank_cash_economy_code' => $vmsIntegrationSetting->tms_bank_cash_economy_code ?? null]);
        session(['_old_input.pms_bank_cash_economy_code' => $vmsIntegrationSetting->pms_bank_cash_economy_code ?? null]);
    }

    public function clearSessionValues()
    {
        if (session()->has('_old_input.salary_rule_id')) {
            session()->forget('_old_input.salary_rule_id');
        }
        if (session()->has('_old_input.tms_sub_sector_id')) {
            session()->forget('_old_input.tms_sub_sector_id');
        }
        if (session()->has('_old_input.fuel_bill_economy_code')) {
            session()->forget('_old_input.fuel_bill_economy_code');
        }
        if (session()->has('_old_input.vehicle_maintenance_economy_code')) {
            session()->forget('_old_input.vehicle_maintenance_economy_code');
        }
        if (session()->has('_old_input.project_economy_code')) {
            session()->forget('_old_input.project_economy_code');
        }
        if (session()->has('_old_input.accounts_bank_cash_economy_code')) {
            session()->forget('_old_input.accounts_bank_cash_economy_code');
        }
        if (session()->has('_old_input.tms_bank_cash_economy_code')) {
            session()->forget('_old_input.tms_bank_cash_economy_code');
        }
        if (session()->has('_old_input.pms_bank_cash_economy_code')) {
            session()->forget('_old_input.pms_bank_cash_economy_code');
        }
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $setting = $this->save($data);
            DB::commit();
            return $setting;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('VMS Integration Feature Store Error : ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data, VmsIntegrationSetting $vmsIntegrationSetting)
    {
        try {
            DB::beginTransaction();
            $setting = $this->update($vmsIntegrationSetting, $data);
            DB::commit();
            return $setting;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('VMS Integration Feature Update Error : ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function getActiveSetting()
    {
        return $this->findBy(['status' => 'active'])->first();
    }


}


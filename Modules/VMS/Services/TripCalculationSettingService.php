<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HRM\Entities\Employee;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\TripCalculationSetting;
use Modules\VMS\Repositories\TripCalculationSettingRepository;
use Modules\VMS\Repositories\TripRepository;

class TripCalculationSettingService
{
    use CrudTrait;

    /**
     * @var TripCalculationSettingRepository
     */
    private $tripCalculationSettingRepository;

    /**
     * @var TripLimitService
     */
    private $tripLimitService;

    public function __construct(
        TripCalculationSettingRepository $tripCalculationSettingRepository,
        TripLimitService $tripLimitService
    ) {
        $this->setActionRepository($tripCalculationSettingRepository);
        $this->tripLimitService = $tripLimitService;
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $data = $this->modifyData($data);
            $this->save($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("TripCalculationSetting Store Error" . $e->getMessage() . " trace:" . $e->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data, TripCalculationSetting $tripCalculationSetting)
    {
        try {
            DB::beginTransaction();
            $data = $this->modifyData($data);
            $this->update($tripCalculationSetting, $data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("TripCalculationSetting Update Error" . $e->getMessage() . " trace:" . $e->getTraceAsString());
            return false;
        }
    }


    public function setSessionValues(TripCalculationSetting $tripCalculationSetting)
    {
        $status = $this->getStatus();
        session(['_old_input.title' => $tripCalculationSetting->title ?? trans('labels.not_found')]);
        session(['_old_input.per_km_taka' => $tripCalculationSetting->per_km_taka ?? trans('labels.not_found')]);
        session(['_old_input.per_hour_taka' => $tripCalculationSetting->per_hour_taka ?? trans('labels.not_found')]);
        session(['_old_input.oil_price' => $tripCalculationSetting->oil_price ?? trans('labels.not_found')]);
        session(['_old_input.gas_price' => $tripCalculationSetting->gas_price ?? trans('labels.not_found')]);
        session(['_old_input.is_exceed_setting' => $tripCalculationSetting->is_exceed_setting ?? trans('labels.not_found')]);
        if ($tripCalculationSetting->status == $status['active']) {
            session(['_old_input.status' => 1]);
        } else {
            session(['_old_input.status' => 0]);
        }
    }

    public function clearSessionValues()
    {
        if (session()->has('_old_input.title')) {
            session()->forget('_old_input.title');
        }
        if (session()->has('_old_input.per_km_taka')) {
            session()->forget('_old_input.per_km_taka');
        }
        if (session()->has('_old_input.per_hour_taka')) {
            session()->forget('_old_input.per_hour_taka');
        }
        if (session()->has('_old_input.oil_price')) {
            session()->forget('_old_input.oil_price');
        }
        if (session()->has('_old_input.gas_price')) {
            session()->forget('_old_input.gas_price');
        }
        if (session()->has('_old_input.is_exceed_setting')) {
            session()->forget('_old_input.is_exceed_setting');
        }
        if (session()->has('_old_input.status')) {
            session()->forget('_old_input.status');
        }
    }

    public function getActiveSettingForTrip(Employee $employee)
    {
        // if the requester crossed his max trip limits, then get the exceed setting
        $hasRequesterCrossedTripLimits = $this->tripLimitService->hasRequesterCrossedTripLimits($employee);
        if ($hasRequesterCrossedTripLimits) {
            return $this->getActiveSetting(true);
        } else {
            return $this->getActiveSetting();
        }
    }

    public function getActiveSetting($exceedSetting = false)
    {
        $status = TripCalculationSetting::getStatus();
        if ($exceedSetting) {
            return $this->findBy(['status' => $status['active'], 'is_exceed_setting' => 1])->first();
        }
        return $this->findBy(['status' => $status['active']])->first();
    }

    //--------------------------------------------------------------------------------------------------------
    //                                      Private Function
    //--------------------------------------------------------------------------------------------------------
    private function modifyData(array $data)
    {
        if (isset($data['status'])) {
            // make inactive the current one
            if (isset($data['is_exceed_setting'])) {
                $activeExceedSetting = $this->getActiveSetting(true);
                if (!is_null($activeExceedSetting)) {
                    $this->update($activeExceedSetting, ['status' => 'inactive']);
                }
                $data['is_exceed_setting'] = 1;
            } else {
                $activeSetting = $this->getActiveSetting();
                if (!is_null($activeSetting)) {
                    $this->update($activeSetting, ['status' => 'inactive']);
                }
            }
            $data['status'] = TripCalculationSetting::getStatus()['active'];
        } else {
            if (isset($data['is_exceed_setting'])) {
                $data['is_exceed_setting'] = 1;
            } else {
                $data['is_exceed_setting'] = 0;
            }
            $data['status'] = TripCalculationSetting::getStatus()['inactive'];
        }
        return $data;
    }

    private function getStatus()
    {
        return TripCalculationSetting::getStatus();
    }


}


<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Repositories\VehicleFuelBillSubmitRepository;
use Modules\VMS\Services\VehicleFuelBillWorkFlowService;
use Modules\VMS\Entities\VehicleFuelBillSubmit as FuelBill;

class VehicleFuelBillSubmitService
{
    use CrudTrait;
    use FileTrait;

    private $vehicleFuelBillSubmitRepository;
    private $vehicleFuelBillWorkFlowService;

    /**
     * VehicleFuelBillSubmitService constructor.
     * @param VehicleFuelBillSubmitRepository $vehicleFuelBillSubmitRepository
     * @param \Modules\VMS\Services\VehicleFuelBillWorkFlowService $vehicleFuelBillWorkFlowService
     */
    public function __construct(
        VehicleFuelBillSubmitRepository $vehicleFuelBillSubmitRepository,
        VehicleFuelBillWorkFlowService $vehicleFuelBillWorkFlowService
    )
    {
        $this->vehicleFuelBillSubmitRepository = $vehicleFuelBillSubmitRepository;
        $this->vehicleFuelBillWorkFlowService = $vehicleFuelBillWorkFlowService;
        $this->setActionRepository($this->vehicleFuelBillSubmitRepository);
    }


    /**
     * @param $data
     * @param $name
     * @return null[]
     */
    public function storeRequestFiles($data, $name): array
    {

        $photoPath = array_key_exists("$name", $data) ? $this->upload($data["$name"], 'vms_fuel_bill_attachment') : null;

        return array($photoPath);
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function store(array $data)
    {
        $inputData = $data;
        $acknowledgement_one = $this->storeRequestFiles($inputData, 'acknowledgement_one');
        $inputData['acknowledgement_one'] = $acknowledgement_one[0];

        if (isset($inputData['acknowledgement_two'])) {
            $acknowledgement_two = $this->storeRequestFiles($inputData['acknowledgement_two'], 'acknowledgement_two');
            $inputData['acknowledgement_two'] = $acknowledgement_two[0];
        }
        $inputData['date'] = Carbon::parse($inputData['date'])->format('Y-m-d');

        try {
            $fuelBill = $this->vehicleFuelBillSubmitRepository->save($inputData);
            //todo:: start the workflow
            $workFowCall = $this->vehicleFuelBillWorkFlowService->start($fuelBill);
            return true;

        } catch (Exception $exception) {
            Log::error('Fuel Bill Submit Error: ' . $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param FuelBill $fuelBill
     * @param $status
     * @return false|FuelBill
     */

    public function changeStatus(FuelBill $fuelBill, $status)
    {
        try {
            DB::beginTransaction();
            if ($status == FuelBill::getStatuses()['approved']) {
                // approval has a workflow !
                $this->vehicleFuelBillWorkFlowService->approve($fuelBill);
            } elseif ($status == FuelBill::getStatuses()['rejected']) {
                if (!$this->vehicleFuelBillWorkFlowService->canUserRejectTrip($fuelBill)) {
                    throw  new Exception('User do not have the permission to perform this action !');
                }
                $fuelBill->update(['status' => FuelBill::getStatuses()[$status]]);
            } elseif ($status == Trip::getStatuses()['completed']) {
                $fuelBill->update(['status' => FuelBill::getStatuses()[$status]]);
            } else {
                $fuelBill->update(['status' => FuelBill::getStatuses()[$status]]);
            }
//            $this->vehicleService->changeStatusByTripStatus($trip, $status);
            DB::commit();
            return $fuelBill;
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

}


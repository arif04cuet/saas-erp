<?php

namespace Modules\VMS\Services;

use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Repositories\VehicleRepository;
use Modules\VMS\Repositories\VehicleMaintenanceRequisitionRepository;
use Modules\VMS\Repositories\VehicleMaintenanceRequisitionDetailsRepository as RequisitionDetailsRepository;
use Modules\VMS\Services\RequisitionWorkFlowService;
use Modules\VMS\Entities\VehicleMaintenanceRequisitionDetails;
use Modules\VMS\Entities\VehicleMaintenanceRequisition;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Auth;


class VehicleMaintenanceRequisitionService
{
    use CrudTrait;

    /**
     * @var $vehicleFuelLogRepository
     * @var $vehicleMaintenanceRequisitionRepository
     * @var $requisitionDetailsRepository
     */

    private $vehicleMaintenanceRequisitionRepository;
    private $vehicleRepository;
    private $requisitionDetailsRepository;
    private $requisitionWorkFlowService;

    /**
     * VehicleFuelLogService constructor.
     * @param VehicleRepository $vehicleRepository
     * @param VehicleMaintenanceRequisitionRepository $vehicleFillingStationRepository
     * @param RequisitionWorkFlowService $requisitionWorkFlowService
     */

    public function __construct(
        VehicleRepository $vehicleRepository,
        RequisitionDetailsRepository $requisitionDetailsRepository,
        VehicleMaintenanceRequisitionRepository $vehicleMaintenanceRequisitionRepository,
        RequisitionWorkFlowService $requisitionWorkFlowService
    )
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->requisitionDetailsRepository = $requisitionDetailsRepository;
        $this->vehicleMaintenanceRequisitionRepository = $vehicleMaintenanceRequisitionRepository;
        $this->requisitionWorkFlowService = $requisitionWorkFlowService;
        $this->setActionRepository($this->vehicleMaintenanceRequisitionRepository);
    }

    /**
     * @param array $data
     * @return bool
     */

    public function store(array $data)
    {
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        $data['requester_id'] = Auth::id();

        try {
            DB::transaction(function () use ($data) {
                $requisition = $this->vehicleMaintenanceRequisitionRepository->save($data);
                foreach ($data['requisition_item'] as $requisitionItem) {
                    $requisitionList = array();
                    $requisitionList['requisition_id'] = $requisition->id;
                    $requisitionList['item_id'] = $requisitionItem['item_id'];
                    $requisitionList['quantity'] = $requisitionItem['quantity'];

                    $this->requisitionDetailsRepository->save($requisitionList);

                }
                //TODo:: Star work flow
                $workFowCall = $this->requisitionWorkFlowService->start($requisition);
            });

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Maintenance requisition Feature Store Error : ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param false $isEmptyOption
     * @return array
     */
    public function getVehiclesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $vehicles = $query ? $this->vehicleRepository->findBy($query) : $this->vehicleRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $vehicles,
            $implementedKey ?: function ($vehicles) {
                return $vehicles->id;
            },
            $implementedValue ?: function ($vehicles) {
                return $vehicles->name;
            },
            $isEmptyOption
        );
    }

    /**
     * @return string
     */
    public function getNextSerialNumber()
    {
        // Get the max number
        $lastOrder = $this->vehicleMaintenanceRequisitionRepository->max();
        if (empty($lastOrder)) {
            $lastOrder = 0;
        }
        $number = $lastOrder;
        return 'RS' . Auth::id() . sprintf('%06d', intval($number) + 1);
    }

    /**
     * @param $id
     * @return mixed
     */

    public function requisitionItemDetails($id)
    {
        return VehicleMaintenanceRequisitionDetails::where('requisition_id', $id)->get();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function updateItemPrice(array $data)
    {
        $amount = 0;
        foreach ($data['requisition'] as $key => $info) {
            $data['requisition'][$key]['requisition_id'] = $data['requisition_id'];
            $updateData = $data['requisition'][$key];
            $this->requisitionDetailsRepository->findOrFail($info['id'])->update($updateData);
            $amount += $info['price'];
        }
        $updateRequisition = ['update_by' => Auth::id(), 'total_amount' => $amount];
        $update = $this->vehicleMaintenanceRequisitionRepository->findOrFail($data['requisition_id'])->update($updateRequisition);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string[]
     */
    public function getStatusClassArray()
    {
        return [
            'approved' => 'primary',
            'completed' => 'success',
            'pending' => 'warning',
            'draft' => 'warning',
            'rejected' => 'danger',
            'cancelled' => 'danger',
            'ongoing' => 'warning'
        ];
    }

    /**
     * @param VehicleMaintenanceRequisition $vmr
     * @param $status
     * @return false|FuelBill
     */

    public function changeStatus(VehicleMaintenanceRequisition $vmr, $status)
    {
        try {
            DB::beginTransaction();
            if ($status == VehicleMaintenanceRequisition::getStatuses()['approved']) {
                // approval has a workflow !
             $this->requisitionWorkFlowService->approve($vmr);
            } elseif ($status == VehicleMaintenanceRequisition::getStatuses()['rejected']) {
                if (!$this->requisitionWorkFlowService->canUserRejectTrip($vmr)) {
                    throw  new Exception('User do not have the permission to perform this action !');
                }
                $vmr->update(['status' => VehicleMaintenanceRequisition::getStatuses()[$status]]);
            } elseif ($status == VehicleMaintenanceRequisition::getStatuses()['completed']) {
                $vmr->update(['status' => VehicleMaintenanceRequisition::getStatuses()[$status]]);
            } else {
                $vmr->update(['status' => VehicleMaintenanceRequisition::getStatuses()[$status]]);
            }
            DB::commit();
            return $vmr;
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }
    }
}


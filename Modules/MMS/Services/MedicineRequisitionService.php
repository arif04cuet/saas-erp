<?php

namespace Modules\MMS\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\MMS\Repositories\MedicineRequisitionRepository;
use Modules\MMS\Repositories\MedicineRequisitionDetailsRepository;

class MedicineRequisitionService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $medicineRequisitionRepository
     */

    private $medicineRequisitionRepository;
    /**
     * @var $medicineRequisitionDetailsRepository
     */
    private $medicineRequisitionDetailsRepository;

    /**
     *  MedicineRequisitionRepository constructor.
     * @param MedicineRequisitionRepository $medicineRequisitionRepository
     * @param MedicineRequisitionDetailsRepository $medicineRequisitionDetailsRepository
     */

    public function __construct(
        MedicineRequisitionRepository $medicineRequisitionRepository,
        MedicineRequisitionDetailsRepository $medicineRequisitionDetailsRepository
    )
    {
        $this->medicineRequisitionRepository = $medicineRequisitionRepository;
        $this->medicineRequisitionDetailsRepository = $medicineRequisitionDetailsRepository;
        $this->setActionRepository($this->medicineRequisitionRepository);
    }

    /**
     * @param array $data
     * @return bool
     */

    public function store(array $data)
    {
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        $data['status'] = 0;

        try {
            DB::transaction(function () use ($data) {
                $requisition = $this->medicineRequisitionRepository->save($data);
                foreach ($data['medicine'] as $requisitionItem) {
                    $inventoryItemEntry = array();
                    $medicine_id = $requisitionItem['medicine_id'];
                    $piece = $requisitionItem['piece'];
                    $inventoryItemEntry['requisition_id'] = $requisition->id;
                    $inventoryItemEntry['medicine_id'] = $medicine_id;
                    $inventoryItemEntry['quantity'] = $piece;
                    $this->medicineRequisitionDetailsRepository->save($inventoryItemEntry);
                }
            });
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteMedicineRequisitionDetails($id)
    {
        $requisitionDetails = $this->medicineRequisitionDetailsRepository->findOne($id);
        if ($requisitionDetails) {
            $requisitionDetails->destroy($id);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function requisitionUpdate(array $data)
    {
        $data['updated_by'] = Auth::id();
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        try {
            DB::transaction(function () use ($data) {
                $requisition = $this->medicineRequisitionRepository->findOrFail($data['id']);
                $requisition->update($data);
                foreach ($data['medicine'] as $requisitionItem) {

                    $requisitionItemEntry = array();
                    $medicine_id = $requisitionItem['medicine_id'];
                    $piece = $requisitionItem['piece'];
                    $requisitionItemEntry['requisition_id'] = $requisition->id;
                    $requisitionItemEntry['medicine_id'] = $medicine_id;
                    $requisitionItemEntry['quantity'] = $piece;
                    if (isset($requisitionItem['id']) and $requisitionItem['id'] !== 'null') {
                        $requisitionDetails = $this->medicineRequisitionDetailsRepository->findOrFail($requisitionItem['id']);
                        $requisitionDetails->update($requisitionItemEntry);
                    } else {
                        $this->medicineRequisitionDetailsRepository->save($requisitionItemEntry);
                    }
                }
            });
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function show($id)
    {
        $requisition = $this->findOrFail($id);
        $distributionHistory = $this->medicineRequisitionDetailsRepository->findBy(['requisition_id' => $id]);
        return ['requisition' => $requisition, 'requisitionDetails' => $distributionHistory];

    }

    /**
     * @return string
     */
    public function getNextSerialNumber()
    {
        // Get the last created order
        $lastOrder = $this->max();
        if (empty($lastOrder)) {
            $lastOrder = 0;
        }
        return 'RS' . Auth::id() . sprintf('%06d', intval($lastOrder) + 1);
    }

}


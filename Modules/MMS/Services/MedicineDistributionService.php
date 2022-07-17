<?php


namespace Modules\MMS\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\MMS\Repositories\MedicineInventoryRepository;
use Modules\MMS\Repositories\MedicineInventoryHistoryRepository;
use Modules\MMS\Repositories\MedicineDistributionRepository;
use Modules\MMS\Repositories\MedicineDistributionHistoryRepository;
use Carbon\Carbon;
use Modules\MMS\Repositories\PatientRepository;
use Modules\MMS\Repositories\PrescriptionRepository;

class MedicineDistributionService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $medicineInventoryRepository
     * @var $medicineInventoryHistoryRepository
     * @var $medicineDistributionRepository
     * @var $medicineDistributionHistoryRepository
     * @var $patientRepository
     */

    private $medicineInventoryRepository;
    private $medicineInventoryHistoryRepository;
    private $medicineDistributionRepository;
    private $medicineDistributionHistoryRepository;
    private $patientRepository;
    private $prescriptionRepository;

    /**
     * MedicineDistributionService constructor.
     * @param MedicineInventoryRepository $medicineInventoryRepository
     * @param MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository
     * @param MedicineDistributionRepository $medicineDistributionRepository
     * @param MedicineDistributionHistoryRepository $medicineDistributionHistoryRepository
     * @param PatientRepository $patientRepository
     */

    public function __construct(
        MedicineInventoryRepository $medicineInventoryRepository,
        MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository,
        MedicineDistributionRepository $medicineDistributionRepository,
        MedicineDistributionHistoryRepository $medicineDistributionHistoryRepository,
        PatientRepository $patientRepository,
        PrescriptionRepository $prescriptionRepository
    )
    {
        $this->medicineInventoryRepository = $medicineInventoryRepository;
        $this->medicineInventoryHistoryRepository = $medicineInventoryHistoryRepository;
        $this->medicineDistributionRepository = $medicineDistributionRepository;
        $this->medicineDistributionHistoryRepository = $medicineDistributionHistoryRepository;
        $this->patientRepository = $patientRepository;
        $this->prescriptionRepository = $prescriptionRepository;
        $this->setActionRepository($this->medicineDistributionRepository);
    }

    /**
     * @param array $data
     * @return bool
     */

    public function store(array $data)
    {
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        $data['status'] = 0;
        $prescriptionInfo = $this->prescriptionRepository->findOne($data['patient_id']);
        $data['patient_id'] = $prescriptionInfo->patient_id;
        $data['prescription_id'] = $prescriptionInfo->id;
        try {
            DB::transaction(function () use ($data) {
                $distribution = $this->medicineDistributionRepository->save($data);
                foreach ($data['medicine'] as $inventoryItem) {
                    $inventoryItemEntry = array();
                    $medicine_id = $inventoryItem['medicine_id'];
                    $piece = $inventoryItem['piece'];
                    $inventoryItemEntry['distribution_id'] = $distribution->id;
                    $inventoryItemEntry['medicine_id'] = $medicine_id;
                    $inventoryItemEntry['quantity'] = $piece;

                    $inventory = $this->medicineInventoryRepository->findBy(['medicine_id' => $medicine_id])->first();
                    $previous_quantity = $inventory->quantity;
                    $inventory->decrement('quantity', $piece);
                    if ($inventory->save()) {

                        $this->medicineDistributionHistoryRepository->save($inventoryItemEntry);
                        $data['medicine_id'] = $inventoryItem['medicine_id'];
                        $data['quantity'] = $piece;
                        $data['previous_quantity'] = $previous_quantity;
                        $data['updated_by'] = Auth::id();
                        $data['flow_type'] = 'OUT';
                        $this->saveInventoryHistory($data);
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
     * @param $data
     * @return bool
     */
    public function saveInventoryHistory($data)
    {
        $saveData = $this->medicineInventoryHistoryRepository->save($data);
        if ($saveData) {
            return true;
        } else {
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
    public function getPatientForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $prescriptionList = $this->prescriptionRepository->prescriptionList();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $prescriptionList,
            $implementedKey ?: function ($prescriptionList) {
                return $prescriptionList->id;
            },
            $implementedValue ?: function ($prescriptionList) {
                return $prescriptionList->name . '- ( ' . $prescriptionList->mobile_no . ' ) - ( ' . $prescriptionList->date . ' )';
            },
            $isEmptyOption
        );
    }

    /**
     * @param $id
     * @return array
     */
    public function show($id)
    {
        $distribution = $this->findOrFail($id);
        $distributionHistory = $this->medicineDistributionHistoryRepository->findBy(['distribution_id' => $id]);
        return ['distribution' => $distribution, 'distributionHistory' => $distributionHistory];

    }

    /**
     * @param $data
     * @return bool
     */
    public function acknowledgementFiles($data)
    {
        $distributionMedicine = $this->medicineDistributionRepository->findOrFail($data['id']);

        $photo = $this->storeRequesterFiles($data);
        if ($distributionMedicine->update(['acknowledgement_slip' => $photo[0], 'status' => 1])) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $data
     * @return array
     */
    private function storeRequesterFiles($data): array
    {
        $photoPath = array_key_exists('photo', $data) ? $this->upload($data['photo'], 'prescription-slip') : null;

        return array($photoPath);
    }

}

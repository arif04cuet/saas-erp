<?php

namespace Modules\MMS\Services;

use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\Role;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\MMS\Repositories\PrescriptionRepository;
use Modules\MMS\Repositories\PrescriptionMedicineRepository;
use Modules\MMS\Repositories\PrescriptionTestRepository;
use Modules\MMS\Repositories\PrescriptionsEoRepository;
use Modules\MMS\Repositories\MedicineInventoryRepository;
use Modules\MMS\Repositories\MedicineInventoryHistoryRepository;
use Modules\MMS\Repositories\MedicineDistributionRepository;
use Modules\MMS\Repositories\MedicineDistributionHistoryRepository;
use Modules\MMS\Repositories\PatientRepository;
use Auth;


class PrescriptionService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $prescriptionRepository
     * @var $prescriptionMedicineRepository
     * @var $prescriptionTestRepository
     * @var $prescriptionsEoRepository
     * @var $medicineInventoryHistoryRepository
     * @var $medicineDistributionRepository
     * @var $medicineDistributionHistoryRepository
     * @var $patientRepository
     */

    private $medicineInventoryRepository;
    private $prescriptionRepository;
    private $prescriptionMedicineRepository;
    private $prescriptionTestRepository;
    private $prescriptionsEoRepository;
    private $medicineInventoryHistoryRepository;
    private $medicineDistributionRepository;
    private $medicineDistributionHistoryRepository;
    private $patientRepository;

    /**
     * @param PrescriptionRepository $prescriptionRepository
     * @param PrescriptionMedicineRepository $prescriptionMedicineRepository
     * @param PrescriptionTestRepository $prescriptionTestRepository
     * @param PrescriptionsEoRepository $prescriptionsEoRepository
     * @param MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository
     * @param MedicineDistributionRepository $medicineDistributionRepository
     * @param MedicineDistributionHistoryRepository $medicineDistributionHistoryRepository
     * @param PatientRepository $patientRepository
     */

    public function __construct(
        PrescriptionRepository $prescriptionRepository,
        PrescriptionMedicineRepository $prescriptionMedicineRepository,
        PrescriptionTestRepository $prescriptionTestRepository,
        PrescriptionsEoRepository $prescriptionsEoRepository,
        MedicineInventoryRepository $medicineInventoryRepository,
        MedicineDistributionRepository $medicineDistributionRepository,
        MedicineDistributionHistoryRepository $medicineDistributionHistoryRepository,
        PatientRepository $patientRepository,
        MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository
    )
    {
        $this->prescriptionRepository = $prescriptionRepository;
        $this->prescriptionMedicineRepository = $prescriptionMedicineRepository;
        $this->prescriptionTestRepository = $prescriptionTestRepository;

        $this->prescriptionsEoRepository = $prescriptionsEoRepository;
        $this->medicineInventoryRepository = $medicineInventoryRepository;
        $this->medicineInventoryHistoryRepository = $medicineInventoryHistoryRepository;
        $this->medicineDistributionRepository = $medicineDistributionRepository;
        $this->medicineDistributionHistoryRepository = $medicineDistributionHistoryRepository;
        $this->patientRepository = $patientRepository;
        $this->setActionRepository($this->prescriptionRepository);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        $acknowledgementFiles = $this->acknowledgementFiles($data);
        if (!empty($acknowledgementFiles[0])) {
            $data['acknowledgement_slip'] = $acknowledgementFiles[0];
        }
        try {
            DB::transaction(function () use ($data) {
                $prescription = $this->prescriptionRepository->save($data);
                if (isset($data['medicine'])) {
                    foreach ($data['medicine'] as $prescriptionItem) {
                        $prescriptionMedicine = array();
                        if (isset($prescriptionItem['medicine_id'])) {
                            $medicine_id = $prescriptionItem['medicine_id'];
                            $prescriptionMedicine['medicine_id'] = $medicine_id;
                        } else {
                            $prescriptionMedicine['medicine_name'] = $prescriptionItem['medicine_name'];
                        }
                        $prescriptionMedicine['prescription_id'] = $prescription->id;
                        $prescriptionMedicine['dose'] = $prescriptionItem['dose'];
                        $prescriptionMedicine['in_stock'] = $prescriptionItem['in_stock'];
                        $prescriptionMedicine['total_medicine'] = $prescriptionItem['total_medicine'];
                        $prescriptionMedicine['type'] = !empty($prescriptionItem['type']) ? $prescriptionItem['type'] : 0;
                        $this->prescriptionMedicineRepository->save($prescriptionMedicine);

                    }
                }
                if (isset($data['test'])) {
                    foreach ($data['test'] as $prescriptionTestItem) {
                        $prescriptionTest = array();
                        $prescriptionTest['prescription_id'] = $prescription->id;
                        $prescriptionTest['test_name'] = $prescriptionTestItem['test_name'];
                        $this->prescriptionTestRepository->save($prescriptionTest);
                    }
                }
                if (isset($data['oe'])) {
                    foreach ($data['oe'] as $prescriptionOeItem) {
                        $prescriptionOE = array();
                        $prescriptionOE['prescription_id'] = $prescription->id;
                        $prescriptionOE['oe_name'] = $prescriptionOeItem['oe_name'];
                        $prescriptionOE['oe_value'] = $prescriptionOeItem['oe_value'];
                        $this->prescriptionsEoRepository->save($prescriptionOE);
                    }
                }
                $this->sendNotification($prescription);
            });
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    public function sendNotification($prescription)
    {
        $notificationTypeName = 'MMS_PATIENT_REGISTRATION';
        $notificationType = NotificationType::firstOrNew(['name' => \App\Constants\NotificationType::getConstant($notificationTypeName)]);
        if (!isset($notificationType->id)) {
            $notificationType->name = \App\Constants\NotificationType::getConstant($notificationTypeName);
            $notificationType->save();
        }
        $roles = Role::where('name', 'ROLE_PHARMACIST')->first();
        if (!empty($roles)) {
            foreach ($roles->users as $role) {
                $baseUrl = route('inventories.prescribed.create') . '?id=' . $prescription->id;
                Notification::create([
                    'type_id' => $notificationType->id,
                    'ref_table_id' => $prescription->id,
                    'from_user_id' => \Illuminate\Support\Facades\Auth::id(),
                    'to_user_id' => $role->id,
                    'message' => trans('mms::prescription.prescription_notification') . $prescription->name,
                    'item_url' => $baseUrl
                ]);
            }
            return true;
        }
        return false;
    }

    /**
     * @param array $data
     * @return bool
     */

    public function distriButStore(array $data)
    {
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        $data['status'] = 0;

        try {
            DB::transaction(function () use ($data) {
                $distribution = $this->medicineDistributionRepository->save($data);
                if (isset($data['medicine'])) {
                    foreach ($data['medicine'] as $inventoryItem) {
                        if (!empty($inventoryItem['medicine_id'])) {
                            $inventoryItemEntry = array();
                            $medicine_id = $inventoryItem['medicine_id'];
                            $piece = $inventoryItem['in_stock'];
                            $inventoryItemEntry['distribution_id'] = $distribution->id;
                            $inventoryItemEntry['medicine_id'] = $medicine_id;
                            $inventoryItemEntry['quantity'] = $piece;
                            $inventory = $this->medicineInventoryRepository->findBy(['medicine_id' => $medicine_id])->first();
                            $previous_quantity = $inventory->quantity;
                            $storeAmount = ($inventory->quantity) - $piece;
                            if ($inventory->update(['quantity' => $storeAmount])) {
                                $this->medicineDistributionHistoryRepository->save($inventoryItemEntry);
                                $data['medicine_id'] = $inventoryItem['medicine_id'];
                                $data['quantity'] = $piece;
                                $data['previous_quantity'] = $previous_quantity;
                                $data['updated_by'] = Auth::id();
                                $data['flow_type'] = 'OUT';
                                $this->saveInventoryHistory($data);
                            }
                        }
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
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function medicineDetails($id)
    {
        return $this->prescriptionMedicineRepository->findBy(['prescription_id' => $id]);

    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function medicineOE($id)
    {
        return $this->prescriptionsEoRepository->findBy(['prescription_id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function medicineTestDetails($id)
    {
        return $this->prescriptionTestRepository->findBy(['prescription_id' => $id]);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePrescriptionMedicine($id)
    {
        $medicineDetails = $this->prescriptionMedicineRepository->findOne($id);
        if ($medicineDetails) {
            $medicineDetails->destroy($id);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePrescriptionTest($id)
    {
        $testDetails = $this->prescriptionTestRepository->findOne($id);
        if ($testDetails) {
            $testDetails->destroy($id);
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param array $data
     * @return bool
     */

    public function update(array $data)
    {
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        $acknowledgementFiles = $this->acknowledgementFiles($data);
        if (!empty($acknowledgementFiles[0])) {
            $data['acknowledgement_slip'] = $acknowledgementFiles[0];
        }
        try {
            DB::transaction(function () use ($data) {
                $prescription = $this->prescriptionRepository->findOrFail($data['id']);
                $prescription->update($data);
                if (isset($data['medicine'])) {
                    foreach ($data['medicine'] as $prescriptionItem) {
                        $prescriptionMedicine = array();
                        if (isset($prescriptionItem['medicine_id'])) {
                            $medicine_id = $prescriptionItem['medicine_id'];
                            $prescriptionMedicine['medicine_id'] = $medicine_id;
                        } else {
                            $prescriptionMedicine['medicine_name'] = $prescriptionItem['medicine_name'];

                        }
                        $prescriptionMedicine['prescription_id'] = $prescription->id;
                        $prescriptionMedicine['dose'] = $prescriptionItem['dose'];
                        $prescriptionMedicine['in_stock'] = $prescriptionItem['in_stock'];
                        $prescriptionMedicine['total_medicine'] = $prescriptionItem['total_medicine'];

                        if (isset($prescriptionItem['id']) and $prescriptionItem['id'] !== 'null') {
                            $medicineDetails = $this->prescriptionMedicineRepository->findOrFail($prescriptionItem['id']);
                            $medicineDetails->update($prescriptionMedicine);
                        } else {
                            $this->prescriptionMedicineRepository->save($prescriptionMedicine);
                        }
                    }
                }
                if (isset($data['test'])) {
                    foreach ($data['test'] as $prescriptionTestItem) {
                        $prescriptionTest = array();
                        $prescriptionTest['prescription_id'] = $prescription->id;
                        $prescriptionTest['test_name'] = $prescriptionTestItem['test_name'];

                        if (isset($prescriptionTestItem['id']) and $prescriptionTestItem['id'] !== 'null') {
                            $testDetails = $this->prescriptionTestRepository->findOrFail($prescriptionTestItem['id']);
                            $testDetails->update($prescriptionTest);
                        } else {
                            $this->prescriptionTestRepository->save($prescriptionTest);
                        }
                    }
                }
                if (isset($data['oe'])) {
                    foreach ($data['oe'] as $prescriptionOeItem) {
                        $prescriptionOE = array();
                        $prescriptionOE['prescription_id'] = $prescription->id;
                        $prescriptionOE['oe_name'] = $prescriptionOeItem['oe_name'];
                        $prescriptionOE['oe_value'] = $prescriptionOeItem['oe_value'];
                        if (isset($prescriptionOeItem['id']) and $prescriptionOeItem['id'] !== 'null') {
                            $OEDetails = $this->prescriptionsEoRepository->findOrFail($prescriptionOeItem['id']);
                            $OEDetails->update($prescriptionOE);
                        }
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
    public function acknowledgementFiles($data): array
    {
        $photoPath = array_key_exists('acknowledgement_slip', $data) ? $this->upload($data['acknowledgement_slip'], 'prescription') : null;
        return array($photoPath);
    }


}


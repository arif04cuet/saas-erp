<?php

namespace Modules\MMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\HM\Entities\Medicine;
use Modules\MMS\Repositories\MedicineRepository;
use App\Utilities\DropDownDataFormatter;
use Modules\MMS\Services\MedicineGroupService;
use Illuminate\Support\Facades\Log;
use Modules\MMS\Services\MedicineInventoryHistoryService;

class MedicineService
{
    use CrudTrait;

    /**
     * @var $medicineRepository
     */

    private $medicineRepository;

    /**
     * @var $medicineGroupService
     */
    private $medicineGroupService;

    /**
     * @param MedicineRepository $medicineRepository
     * @param MedicineGroupService $medicineGroupService
     */

    public function __construct(
        MedicineRepository $medicineRepository,
        MedicineGroupService $medicineGroupService
    )
    {
        $this->medicineRepository = $medicineRepository;
        $this->medicineGroupService = $medicineGroupService;
        $this->setActionRepository($this->medicineRepository);
    }

    public function getMedicineList()
    {
        $this->medicineRepository->findAll();
    }

    /**
     * @param $request
     * @return bool
     */
    public function store($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $medicineData = [];
                $medicineData['name'] = $request['name'];
                $medicineData['company_name'] = $request['company_name'];
                $medicineData['generic_name'] = $request['generic_name'];
                $medicineData['category_id'] = (!empty($request['category_id'])) ? $request['category_id'] : null;
                if (!empty($request['group_name'])) {
                    $group_data_input = ['name' => $request['group_name']];
                    $medicine_group = $this->medicineGroupService->save($group_data_input);
                    $medicineData['group_id'] = $medicine_group->id;
                } else {
                    $medicineData['group_id'] = $request['group_id'];
                }
                $this->save($medicineData);
            });
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */

    public function medicineUpdate($request, $id)
    {
        if (!empty($request['group_name'])) {
            $group_data_input = ['name' => $request['group_name']];
            $medicine_group = $this->medicineGroupService->save($group_data_input);
            $request['group_id'] = $medicine_group->id;
        }
        return $this->findOne($id)->update($request);
    }


    /**
     * <h3>Medicine Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     *
     * @return array
     */
    public function getMedicineForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $medicine_group = $query ? $this->medicineRepository->findBy($query) : $this->medicineRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $medicine_group,
            $implementedKey,
            $implementedValue ?: function ($medicine_group) {
                return $medicine_group->name;
            },
            $isEmptyOption
        );
    }

}

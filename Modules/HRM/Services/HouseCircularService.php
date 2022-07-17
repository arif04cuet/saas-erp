<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\HouseCircular;
use Modules\HRM\Repositories\HouseCircularRepository;
use MongoDB\Driver\Session;

class HouseCircularService
{
    use CrudTrait;

    /**
     * @var $houseCircularRepository
     */

    private $houseCircularRepository;

    /**
     * @var $houseCircularCategoryService
     */

    private $houseCircularCategoryService;

    /**
     * @var $houseCiruclarHouseService
     */

    private $houseCircularHouseService;

    /**
     * @var $houseCircularDesignationService
     */

    private $houseCircularDesignationService;

    /**
     * @param HouseCircularRepository $houseCircularRepository
     * @param HouseCircularCategoryService $houseCircularCategoryService
     * @param HouseCircularHouseService $houseCircularHouseService
     * @param HouseCircularDesignationService $houseCircularDesignationService
     */

    public function __construct(
        HouseCircularRepository $houseCircularRepository,
        HouseCircularCategoryService $houseCircularCategoryService,
        HouseCircularHouseService $houseCircularHouseService,
        HouseCircularDesignationService $houseCircularDesignationService
    ) {
        $this->houseCircularRepository = $houseCircularRepository;
        $this->setActionRepository($this->houseCircularRepository);
        $this->houseCircularCategoryService = $houseCircularCategoryService;
        $this->houseCircularHouseService = $houseCircularHouseService;
        $this->houseCircularDesignationService = $houseCircularDesignationService;
    }

    public function findAllCircular()
    {
        if (!Auth::user()->can('hrm-user-access')) {
            $circulars = $this->findBy(['status' => 'active'], null, ['column' => 'id', 'direction' => 'desc']);
        } else {
            $circulars = $this->findAll(null, null, ['column' => 'id', 'direction' => 'desc']);
        }

        return $circulars;
    }

    public function storeHouseCircular(array $data)
    {
        DB::transaction(function () use ($data) {

            $circular = $this->save($data);

            foreach ($data['house-entries'] as $categoryData) {
                $categoryData['house_circular_id'] = $circular->id;
                $category = $this->houseCircularCategoryService->save($categoryData);

                $circularId = $circular->id;
                $categoryId = $category->id;

                $this->saveCircularHouses($categoryData, $circularId, $categoryId);
                $this->saveCircularDesignations($categoryData, $circularId, $categoryId);
            }

            return $circular;
        });
    }

    public function updateHouseCircular(array $data, $circularId)
    {
        DB::transaction(function () use ($data, $circularId) {

            $circular = $this->findOrFail($circularId)->update($data);

            foreach ($data['house-entries'] as $categoryData) {
                $isItemExist = !empty($categoryData['circular_category_id'])
                    ? $this->houseCircularCategoryService->hasItemInList($categoryData['circular_category_id'])
                    : false;

                if (!$isItemExist) {
                    $categoryData['house_circular_id'] = $circularId;
                    $category = $this->houseCircularCategoryService->save($categoryData);
                    $categoryId = $category->id;
                } else {
                    $categoryId = $categoryData['circular_category_id'];
                    $this->houseCircularHouseService->deleteCircularHouses($categoryId);
                    $this->houseCircularDesignationService->deleteCircularDesignations($categoryId);
                }

                $this->saveCircularHouses($categoryData, $circularId, $categoryId);
                $this->saveCircularDesignations($categoryData, $circularId, $categoryId);

                $getAllItemId = collect($data['house-entries'])->pluck('circular_category_id')->toArray();

                $this->houseCircularCategoryService->deleteIfItemNotInList($circularId, $getAllItemId);

            }

            return $circular;

        });
    }

    public function saveCircularHouses($categoryData, $circularId, $categoryId)
    {
        /** Store Circular House Details Data */
        foreach ($categoryData['house_details_id'] as $houseDetailsId) {
            $houseDetails['house_circular_id'] = $circularId;
            $houseDetails['house_circular_category_id'] = $categoryId;
            $houseDetails['house_details_id'] = $houseDetailsId;

            $this->houseCircularHouseService->save($houseDetails);
        }

        return true;
    }

    public function saveCircularDesignations($categoryData, $circularId, $categoryId)
    {
        /** Store Circular Designation Data */
        foreach ($categoryData['designation_id'] as $designationId) {
            $designation['house_circular_id'] = $circularId;
            $designation['house_circular_category_id'] = $categoryId;
            $designation['designation_id'] = $designationId;

            $this->houseCircularDesignationService->save($designation);
        }

        return true;
    }

    public function canUserApply(HouseCircular $houseCircular)
    {
        $checkDesignation = false;

        if (is_null($houseCircular)) {
            $checkDesignation = true;
        }

        $approvedDesignations = $houseCircular->circularDesignations;
        $approvedDesignationsId = $approvedDesignations->pluck('designation_id')->toArray();
        $userDesignation = get_user_designation(auth()->user());
        if (!is_null($userDesignation)) {
            if (in_array($userDesignation->id, $approvedDesignationsId)) {
                $checkDesignation = false;
            } else {
                $checkDesignation = true;
            }
        }

        $alreadyApplied = false;

        foreach ($houseCircular->houseApplicants as $applicant) {
            if ($applicant->employee_id == Auth::user()->employee->id) {
                $alreadyApplied = true;
            }
        }

        if ($checkDesignation) {
            return [
                'isValid' => $checkDesignation,
                'message' => trans('hrm::circular.flash_messages.can_user_apply.error')
            ];
        } elseif ($alreadyApplied) {
            return [
                'isValid' => $alreadyApplied,
                'message' => trans('hrm::circular.flash_messages.already_applied')
            ];
        } else {
            return [
                'isValid' => false,
            ];
        }
    }
}


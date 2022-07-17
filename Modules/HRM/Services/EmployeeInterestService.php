<?php

namespace Modules\HRM\Services;

use Illuminate\Support\Facades\DB;
use App\Http\Responses\DataResponse;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Repositories\EmployeeInterestRepository;
use Modules\HRM\Services\AreaOfInterestService;

class EmployeeInterestService
{
    use CrudTrait;

    /**
     * @var $employeeInterestRepository
     */

    private $employeeInterestRepository;

    /**
     * @var $areaOfInterestService
     */

    private $areaOfInterestService;

    /**
     * @param AreaOfInterestService $areaOfInterestService
     * @param EmployeeInterestRepository $employeeInterestRepository
     */

    public function __construct(
        EmployeeInterestRepository $employeeInterestRepository,
        AreaOfInterestService $areaOfInterestService
    ) {
        $this->employeeInterestRepository = $employeeInterestRepository;
        $this->setActionRepository($this->employeeInterestRepository);
        $this->areaOfInterestService = $areaOfInterestService;
    }

    public function storeAreaOfInterest($data, $id): DataResponse
    {
        DB::beginTransaction();

        $status  = false;

        foreach($data['interests'] as $interest) {
            $isInterestExists = $this->checkInterestExists($interest);

            /** save all interest subject */
            if ($isInterestExists) {
                $employeeInterestInfo['area_of_interest_id'] = $interest;
                $employeeInfo = $isInterestExists;
            } else {
                $interestInfo['name'] = $interest;
                $interestInfo['created_by'] = Auth::user()->id;
                $employeeInfo = $this->areaOfInterestService->save($interestInfo);
                $employeeInterestInfo['area_of_interest_id'] = $employeeInfo->id;
            }

            /** save only employee interest subject */
            $employeeInterestInfo['employee_id'] = $data['employee_id'];
            $this->save($employeeInterestInfo);

            $status = true;
        }

        if ( $status ) {
            DB::commit();
            return new DataResponse( $employeeInfo, $id, trans('hrm::others_info.update_success'));
        } else {
            DB::rollBack();
            return new DataResponse( $data, null, trans('hrm::others_info.save_fail'), 500 );
        }
    }

    public function updateAreaOfInterest($data, $id): DataResponse
    {
        DB::beginTransaction();

        $status  = false;

        foreach($data['interests'] as $interest) {
            $isInterestExists = $this->checkInterestExists($id);

            /** save all interest subject */
            if ($isInterestExists) {
                $employeeInterestInfo['area_of_interest_id'] = $interest;
                $area_of_interest_id = $interest;
                $employeeInfo = $isInterestExists;
            } else {
                $interestInfo['name'] = $interest;
                $interestInfo['created_by'] = Auth::user()->id;
                $employeeInfo = $this->areaOfInterestService->save($interestInfo);

                $area_of_interest_id = $employeeInfo->id;
                $employeeInterestInfo['area_of_interest_id'] = $area_of_interest_id;
            }

            /** save only employee interest subject */
            $isEmployeeInterstExists = $this->employeeInterestRepository->hasItemInList($area_of_interest_id, $data['employee_id']);

            if (!$isEmployeeInterstExists) {
                $employeeInterestInfo['employee_id'] = $data['employee_id'];
                $this->save($employeeInterestInfo);
            }

            $getAllInterestId[] = $area_of_interest_id;

            $status = true;
        }

        /** Delete Interest if not in list */
        $this->employeeInterestRepository->deleteIfItemNotInList($data['employee_id'], $getAllInterestId);

        if ( $status ) {
            DB::commit();
            return new DataResponse( $employeeInfo, $id, trans('hrm::others_info.update_success'));
        } else {
            DB::rollBack();
            return new DataResponse( $data, null, trans('hrm::others_info.update_fail'), 500 );
        }
    }

    public function checkInterestExists($id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->areaOfInterestService->findOne($id);
    }
}


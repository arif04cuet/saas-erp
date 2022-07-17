<?php

namespace Modules\HRM\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Services\PayscaleService;
use Modules\HRM\Entities\HouseApplication;
use Modules\HRM\Entities\HouseApplicationHouseDetail;
use Modules\HRM\Entities\HouseCircular;
use Modules\HRM\Entities\HouseDetail;
use Modules\HRM\Repositories\HouseApplicationRepository;
use Modules\HRM\Services\EmployeeService;
use App\Entities\Notification\NotificationType;


class HouseApplicationService
{
    use CrudTrait;

    /**
     * @var EmployeeService
     */

    private $employeeService;

    /**
     * @var PayScaleService
     */

    private $payScaleService;

    /**
     * @var HouseApplicationRepository
     */

    private $houseApplicationRepository;
    /**
     * @var  HouseDetailService
     */
    private $houseDetailService;

    /**
     * @var HouseHistoryService
     */
    private $houseHistoryService;

    /**
     * @param EmployeeService $employeeService
     * @param PayscaleService $payscaleService
     * @param HouseDetailService $houseDetailService
     * @param HouseApplicationRepository $houseApplicationRepository
     * @param HouseHistoryService $houseHistoryService
     */


    const HOUSE_ALLOCATION_DESCRIPTION = 'Notification for house allocation.';


    public function __construct(
        EmployeeService $employeeService,
        PayscaleService $payscaleService,
        HouseDetailService $houseDetailService,
        HouseApplicationRepository $houseApplicationRepository,
        HouseHistoryService $houseHistoryService
    ) {
        $this->employeeService = $employeeService;
        $this->payScaleService = $payscaleService;
        $this->houseDetailService = $houseDetailService;
        $this->houseApplicationRepository = $houseApplicationRepository;
        $this->houseHistoryService = $houseHistoryService;
        $this->setActionRepository($this->houseApplicationRepository);
    }


    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $houseApplication = $this->save($data);
            $houseApplication->houseDetails()->saveMany(
                collect($data['house_detail_id'])->map(function ($houseDetailId) use ($houseApplication) {
                    return new HouseApplicationHouseDetail(
                        [
                            'house_detail_id' => $houseDetailId
                        ]
                    );
                })
            );
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('House Application Store Error: ' . $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            return false;
        }
    }

    public function prepareEmployeeData()
    {
        $authId = Auth::user()->id;
        $employee = $this->employeeService->findOne($authId);

        $salaryGrade = $employee->getEmployeeSalaryGrade();
        $salaryIncrement = $employee->getEmployeeSalaryIncrement();
        $maxIncrement = $this->payScaleService->salaryMaxIncrement($salaryGrade);

        $basicSalary = $this->payScaleService->getBasicSalary($salaryGrade, $salaryIncrement);
        $highestSalary = $this->payScaleService->getBasicSalary($salaryGrade, $maxIncrement);


        $employeeInfo = [
            'name' => $employee->first_name . ' ' . $employee->last_name,
            'designation' => $employee->designation->name,
            'department' => $employee->employeeDepartment->name,
            'salary_grade' => $salaryGrade,
            'salary_scale' => $basicSalary . '-' . $highestSalary,
            'salary' => $basicSalary,
            'birth_date' => $employee->employeePersonalInfo->date_of_birth ?? null,
            'bard_joining_date' => $employee->employeePersonalInfo->job_joining_date ?? null,
            'current_position_joining_date' => $employee->employeePersonalInfo->current_position_joining_date ?? null,
        ];

        return (object)$employeeInfo;
    }

    public function getHouseDetailDropdown(HouseCircular $houseCircular)
    {;
        return $houseCircular->circularHouses->each(function ($circularHouse) {
            $name = "";
            $houseDetail = $circularHouse->house;
            if (!is_null($houseDetail)) {
                $name .= $houseDetail->house_id;
                $houseCategory = $houseDetail->category;
                if (!is_null($houseCategory)) {
                    $name .= ' (' . $houseCategory->name . ') ';
                }
            }
            $circularHouse->name = $name;
        })->pluck('name', 'house_details_id');
    }

    public function getHouseApplicationsByCircular(HouseCircular $houseCircular)
    {
        return $houseCircular->houseApplicants->each(function ($houseApplication) {
            $houseApplication->is_allocated = $this->areHousesAlreadyAllocated($houseApplication);
            return $houseApplication;
        });
    }

    public function areHousesAlreadyAllocated(HouseApplication $houseApplication): bool
    {
        $allocated = false;
        foreach ($houseApplication->houseDetails as $houseApplicationHouseDetail) {
            $houseDetail = $houseApplicationHouseDetail->houseDetail;
            if ($houseDetail->status == HouseDetail::getStatuses()['allocated'] && $houseDetail->allocated_to == $houseApplication->employee_id) {
                $allocated = true;
            }
        }
        return $allocated;
    }

    /**
     * @param array $data
     * @param HouseApplication $houseApplication
     * @return bool
     */
    public function allocateHouseDetails(array $data, HouseApplication $houseApplication): bool
    {
        try {
            DB::beginTransaction();
            $houseDetailId = safeArrayValue($data, 'house_detail_id');
            $houseDetail = $this->houseDetailService->findOrFail($houseDetailId);
            $employeeId = $houseApplication->employee_id ?? null;
            if (is_null($employeeId) || is_null($houseDetail)) {
                throw new \Exception('House Application Employee/HouseDetail Not Defined !');
            }
            $this->houseDetailService->update(
                $houseDetail,
                ['allocated_to' => $employeeId, 'status' => HouseDetail::getStatuses()['allocated']]
            );
            $this->houseHistoryService->storeHistory($houseDetail);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('House Application Allocation Error ' . $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }

    public function notifyApplicant($request, $houseApplication)
    {
        $house = $this->houseDetailService->findOrFail($request['house_detail_id']);
        $employee = $this->employeeService->findOrFail($houseApplication->employee_id);
        $userId =  $employee->user->id;
        $message = trans('hrm::house-circular.house_allocation_notification');
        $url = "house-details.show";
        $this->sendHouseAllocantNotification($house, $userId, $message, $url);
    }


    public function getTypeName(): string
    {
        return NotificationTypeConstant::HOUSE_ALLOCATION;
    }

    public function getTypeDescription(): string
    {
        return self::HOUSE_ALLOCATION_DESCRIPTION;
    }


    public function sendHouseAllocantNotification(
        $house,
        $toUserId,
        $message,
        $url
    ) {
        $notificationTypeArr = [
            'name' => $this->getTypeName(),
            'description' => $this->getTypeDescription(),
            'is_application_notification' => 1,
            'is_email_notification' => 0,
            'is_sms_notification' => 0,
            'icon_name' => '',
        ];

        $notificationType = NotificationType::firstOrCreate($notificationTypeArr);

        if ($toUserId && $toUserId != Auth::user()->id) {
            Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $house->id,
                'from_user_id' => Auth::user()->id,
                'to_user_id' => $toUserId,
                'message' => $message,
                'item_url' => route($url, $house->id)
            ]);
        }
    }
}

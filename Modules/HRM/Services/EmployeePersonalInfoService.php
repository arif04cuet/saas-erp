<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/23/2018
 * Time: 3:54 PM
 */

namespace Modules\HRM\Services;


use App\Http\Responses\DataResponse;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Modules\HRM\Repositories\EmployeePersonalInfoRepository;

class EmployeePersonalInfoService
{
    use CrudTrait;
    protected $employeePersonalInfoRepository;
    private $dateFormat = 'j F, Y';

    public function __construct(EmployeePersonalInfoRepository $employeePersonalInfoRepository)
    {
        $this->employeePersonalInfoRepository = $employeePersonalInfoRepository;
        $this->setActionRepository($this->employeePersonalInfoRepository);
    }

    public function storePersonalInfo($data = null)
    {
        if (!is_null($data['date_of_birth'])) $data['date_of_birth'] = Carbon::createFromFormat('j F, Y', $data['date_of_birth'])->format('Y-m-d');
        if (!is_null($data['current_position_joining_date'])) $data['current_position_joining_date'] = Carbon::createFromFormat('j F, Y', $data['current_position_joining_date'])->format('Y-m-d');
        if (!is_null($data['current_position_expire_date'])) $data['current_position_expire_date'] = Carbon::createFromFormat('j F, Y', $data['current_position_expire_date'])->format('Y-m-d');
        if (!is_null($data['job_joining_date'])) $data['job_joining_date'] = Carbon::createFromFormat('j F, Y', $data['job_joining_date'])->format('Y-m-d');
        if (!is_null($data['house_eligibility_date'])) $data['house_eligibility_date'] = Carbon::createFromFormat('j F, Y', $data['house_eligibility_date'])->format('Y-m-d');

        $data = $this->setEmployeeDeathStatus($data);

        $personalInfo = $this->employeePersonalInfoRepository->save($data);

        return new DataResponse($personalInfo, $personalInfo['employee_id'], trans('labels.Personal information added successfully'));
    }

    public function updatePersonalInfo($data, $employeeId)
    {
        if (!is_null($data['date_of_birth'])) $data['date_of_birth'] = Carbon::createFromFormat('j F, Y', $data['date_of_birth'])->format('Y-m-d');
        if (!is_null($data['current_position_joining_date'])) $data['current_position_joining_date'] = Carbon::createFromFormat('j F, Y', $data['current_position_joining_date'])->format('Y-m-d');
        if (!is_null($data['current_position_expire_date'])) $data['current_position_expire_date'] = Carbon::createFromFormat('j F, Y', $data['current_position_expire_date'])->format('Y-m-d');
        if (!is_null($data['job_joining_date'])) $data['job_joining_date'] = Carbon::createFromFormat('j F, Y', $data['job_joining_date'])->format('Y-m-d');
        if (!is_null($data['house_eligibility_date'])) $data['house_eligibility_date'] = Carbon::createFromFormat('j F, Y', $data['house_eligibility_date'])->format('Y-m-d');

        $data = $this->setEmployeeDeathStatus($data);

        if (is_null($data['id'])) {
            $personalInfo = $this->employeePersonalInfoRepository->save($data);
            $status = true;
        } else {
            $personalInfo = $this->findOrFail($data['id']);
            $status = $personalInfo->update($data);
        }
        if ($status) {
            return new DataResponse($personalInfo, $personalInfo['employee_id'], trans('labels.Personal information updated successfully'));
        }
    }

    private function setEmployeeDeathStatus($data = [])
    {
        // check employee death status

        if (isset($data['is_dead'])) {
            $data['is_dead'] = true;
            $data['date_of_death'] = Carbon::createFromFormat('j F, Y', $data['date_of_death'])->format('Y-m-d');
        } else {
            $data['is_dead'] = false;
            $data['date_of_death'] = null;
        }

        return $data;
    }

}

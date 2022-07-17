<?php


namespace Modules\HRM\Services;


use App\Mail\ShortListedApplicantMail;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\HRM\Entities\JobCircular;
use Modules\HRM\Repositories\JobCircularRepository;

class JobCircularService
{
    use CrudTrait;

    protected $jobCircularRepository;
    private $jobCircularDetailService;

    public function __construct(
        JobCircularRepository $jobCircularRepository,
        JobCircularDetailService $jobCircularDetailService
    ) {
        $this->jobCircularRepository = $jobCircularRepository;
        $this->setActionRepository($jobCircularRepository);
        $this->jobCircularDetailService = $jobCircularDetailService;
    }

    public function store(array $data)
    {

        try {
            $data = $this->createDateFromFormat($data, [
                'application_deadline' => 'j F, Y'
            ]);
            $data = $this->setSystemShortlistOption($data);
            $jobCircular = $this->save($data);
            $this->jobCircularDetailService->store($jobCircular, $data);
            DB::commit();
            return $jobCircular;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Job Circular Store Error: ' . $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            return false;
        }
    }

    public function updateRequest(JobCircular $jobCircular, array $data)
    {
        try {
            $data = $this->createDateFromFormat($data, [
                'application_deadline' => 'j F, Y'
            ]);
            $data = $this->setSystemShortlistOption($data);
            $jobCircular = $this->update($jobCircular, $data);
            $this->jobCircularDetailService->updateData($jobCircular, $data);
            DB::commit();
            return $jobCircular;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Job Circular Store Error: ' . $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            return false;
        }
    }

    public function generatJobCircularUniqueId()
    {
        $prefix = "BARD-JC-";
        $id = date('Y-m-s') . rand(9999, 100000);
        $jobCircularId = $prefix . $id;
        return $jobCircularId;
    }

    public function getJobNaturesForDropdown()
    {
        $jobNatures = [];
        $filteredOptions = ['part-time', 'outsourcing'];  // after a discussion at bard at 25th January,2021
        $mustHaveoptions = array_keys(trans('hrm::circular.job_natures'));
        // add must have options
        foreach ($mustHaveoptions as $key => $value) {
            if (!in_array($value, $jobNatures)) {
                array_push($jobNatures, $value);
            }
        }
        $uniqueStoredJobNatures = $this->actionRepository->getUniqueJobNatures();
        $uniqueStoredJobNatures = array_values(array_filter($uniqueStoredJobNatures->toArray()));
        // remove if the must have options already came from the database
        foreach ($mustHaveoptions as $key => $value) {
            if (in_array($value, $uniqueStoredJobNatures)) {
                unset($uniqueStoredJobNatures[$key]);
            }
        }
        // merge db+must-have
        $jobNatures = array_merge($jobNatures, $uniqueStoredJobNatures);
        // remove filtered values
        foreach ($jobNatures as $key => $value) {
            if (in_array($value, $filteredOptions)) {
                unset($jobNatures[$key]);
            }
        }
        $localizedJobNatures = [];
        // now we have to localize these
        foreach ($jobNatures as $key => $value) {
            $localizedJobNatures[$value] =
                array_key_exists($value, trans('hrm::circular.job_natures'))
                    ? trans('hrm::circular.job_natures.' . $value)
                    : $value;
        }

        return $localizedJobNatures;
    }

    /**
     * @param $data
     * @param array $keys
     * @return mixed
     */
    private function createDateFromFormat($data, $keys = [])
    {
        foreach ($keys as $key => $value) {
            $data[$key] = Carbon::createFromFormat($value, $data[$key]);
        }

        return $data;
    }

    private function setSystemShortlistOption($data)
    {
        $data['system_shortlist'] = (!isset($data['system_shortlist'])) ? false : $data['system_shortlist'];
        return $data;
    }

    public function getCircularForDropdown()
    {
        return $this->findAll()->each(function ($circular) {
            return $circular->title_id = $circular->title . ' - ' . $circular->unique_id;
        })->pluck('title_id', 'id');
    }

    public function getDetailsDropdownForJobApplication(JobCircular $jobCircular)
    {
        return $jobCircular->jobCircularDetails->each(function ($jobCircularDetail) {
            return $jobCircularDetail->designation_name = optional($jobCircularDetail->designation)->getName() ?? trans('labels.not_found');
        })->pluck('designation_name', 'id');
    }

    /**
     * @param JobCircular $jobCircular
     * @return array
     */
    public function getMaxAgeLimits(JobCircular $jobCircular): array
    {
        $data = [];
        foreach ($jobCircular->jobCircularDetails as $jobCircularDetail) {
            $temp['max_age'] = $jobCircularDetail->max_age;
            $temp['max_age_divisional_employee'] = $jobCircularDetail->max_age_divisional_employee;
            $temp['max_age_quota_employee'] = $jobCircularDetail->max_age_quota_employee;
            $data[$jobCircularDetail->id] = $temp;
        }
        return $data;
    }

}

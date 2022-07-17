<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Modules\HRM\Entities\JobCircular;
use Modules\HRM\Entities\JobCircularDetail;
use Modules\HRM\Repositories\JobCircularDetailRepository;
use Modules\HRM\Repositories\JobCircularRepository;

class JobCircularDetailService
{
    use CrudTrait;

    /**
     * @var DesignationService
     */
    private $designationService;


    /**
     * @param DesignationService $designationService
     * @param JobCircularDetailRepository $jobCircularDetailRepository
     */

    public function __construct(
        JobCircularDetailRepository $jobCircularDetailRepository,
        DesignationService $designationService
    ) {
        $this->designationService = $designationService;
        $this->setActionRepository($jobCircularDetailRepository);
    }

    /**
     * @param JobCircular $jobCircular
     * @param array $data
     */
    public function store(JobCircular $jobCircular, array $data)
    {
        return $jobCircular->jobCircularDetails()->saveMany(collect($data['job-circular'])->map(function (
            $jobCircularDetail
        )
        use ($data) {
            return new JobCircularDetail($jobCircularDetail);
        }));
    }

    public function updateData(JobCircular $jobCircular, array $data)
    {
        $jobCircular->jobCircularDetails()->delete();
        return $jobCircular->jobCircularDetails()->saveMany(collect($data['job-circular'])->map(function (
            $jobCircularDetail
        )
        use ($data) {
            return new JobCircularDetail($jobCircularDetail);
        }));
    }

    /**
     * |----------------------------------------------------------------------------------------------------------------
     * |                                          Private Methods
     * |----------------------------------------------------------------------------------------------------------------
     */
    private function getJobCircularDetailArray(array $data)
    {

    }
}


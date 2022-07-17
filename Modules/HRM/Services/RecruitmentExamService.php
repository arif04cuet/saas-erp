<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Repositories\RecruitmentExamRepository;

class RecruitmentExamService
{
    use CrudTrait;
    /**
     * @var RecruitmentExamRepository
     */
    private $recruitmentExamRepository;
    /**
     * @var JobCircularService
     */
    private $jobCircularService;

    /**
     * RecruitmentExamService constructor.
     * @param RecruitmentExamRepository $recruitmentExamRepository
     * @param JobCircularService $jobCircularService
     */
    public function __construct(
        RecruitmentExamRepository $recruitmentExamRepository,
        JobCircularService $jobCircularService
    ) {
        $this->recruitmentExamRepository = $recruitmentExamRepository;
        $this->setActionRepository($recruitmentExamRepository);
        $this->jobCircularService = $jobCircularService;
    }

    /**
     * @param array $data
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            return $this->save($data);
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data, $id)
    {
        try {
            return $this->update($this->findOne($id), $data);
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param bool $withEmpty
     * @param null $excludeReject to exclude an item from rejection for having exam (used while edit)
     * @return array
     */
    public function getCirculars($withEmpty = false, $excludeReject = null)
    {
        $circularsHavingExams = $this->findAll()->pluck('job_circular_id')->toArray();
        if (!is_null($excludeReject)) {
            unset($circularsHavingExams[array_search($excludeReject, $circularsHavingExams)]);
        }

        return ($withEmpty ? ['' => __('labels.select')] : []) + $this->jobCircularService->getCircularForDropdown()
            ->reject(function ($circular, $index) use ($circularsHavingExams, $excludeReject){
            return in_array($index, $circularsHavingExams);
        })->toArray();
    }
}


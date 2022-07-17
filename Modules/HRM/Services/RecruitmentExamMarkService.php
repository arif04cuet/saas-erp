<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Services\JobApplicationService;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\JobCircularService;
use Modules\HRM\Services\RecruitmentExamService;
use Modules\HRM\Repositories\RecruitmentExamMarkRepository;

class RecruitmentExamMarkService
{
    use CrudTrait;

    /**
     * @var $recruitmentExamMarkRepository
     */

    private $recruitmentExamMarkRepository;

    /**
     * @var $recruitmentExamService
     */

    private $recruitmentExamService;


    /**
     * @var $jobCircularService
     */

    private $jobCircularService;

        /**
     * @var $jobApplicationService
     */

    private $jobApplicationService;

    /**
     * @param RecruitmentExamMarkRepository $recruitmentExamMarkRepository
     * @param RecruitmentExamService $recruitmentExamService
     * @param JobCircularService $jobCircularService
     * @param JobApplicationService $jobApplicationService
     */

    public function __construct(
        RecruitmentExamMarkRepository $recruitmentExamMarkRepository,
        RecruitmentExamService $recruitmentExamService,
        JobCircularService $jobCircularService,
        JobApplicationService $jobApplicationService
    ) {
        $this->recruitmentExamMarkRepository = $recruitmentExamMarkRepository;
        $this->setActionRepository($this->recruitmentExamMarkRepository);
        $this->recruitmentExamService = $recruitmentExamService;
        $this->jobCircularService = $jobCircularService;
        $this->jobApplicationService = $jobApplicationService;
    }

    public function applicantsResultData($id) {
        
        $circular = $this->jobCircularService->findOne($id);

        return $circular;
    }

    public function storeRecruitmentExamMarks(array $data)
    {
        if ($data['method'] == "store") {
            $this->saveRecruitmentExamMarks($data);
        } else {
            $this->updateRecruitmentExamMarks($data);
        }
    }

    public function saveRecruitmentExamMarks($data)
    {
        try {
            foreach ($data['marks'] as $mark) {
                $this->save($mark);
            }

            $this->recruitmentExamDone($data);

            return true;
        } catch (\Exception $e) {
            $this->saveErrorLog($e);
        }
    }

    public function updateRecruitmentExamMarks($data)
    {
        try {
            foreach ($data['marks'] as $mark) {
                $this->findOrFail($mark['marks_id'])->update($mark);
            }

            $this->recruitmentExamDone($data);

            return true;
        } catch (\Exception $e) {
            $this->saveErrorLog($e);
        }
    }

    public function recruitmentExamDone($data)
    {
        if ($data['submit'] == "completed") {
            $this->recruitmentExamService->findOrFail($data['recruit_exam_id'])
                                            ->update(['status' => $data['submit']]);

            return true;
        }

        return false;
    }

    public function saveErrorLog($e)
    {
        Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
            ['code' => $e->getCode()]));
            
        Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());

        return false;
    }

     /**
     * Applicant status change after final selection
     * @param Array $data
     * @return Response JSON
     */

    public function finalSelectionForRecruitment(array $data)
    {
        $qualified   = Config::get('constants.hrm_status.qualified');
        $shortListed = Config::get('constants.hrm_status.short_listed');

        $applicant = $this->jobApplicationService->findOrFail($data['job_application_id']);

        if ($applicant->status == $shortListed) {
             $applicant->update(['status' => $qualified]);
             $response = trans('job-application.'.$qualified);
        } else {
             $applicant->update(['status' => $shortListed]);
             $response = trans('job-application.'.$shortListed);
        };

        return response()->json($response);
    }

}

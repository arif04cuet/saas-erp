<?php

namespace Modules\HRM\Services\CVEvaluationService;

use Illuminate\Support\Facades\Config;
use App\Services\JobApplicationService;

class CVEvaluationService
{
    /**
     * @var $jobApplicationService
     */

    private $jobApplicationService;

    /**
     * @param JobApplicationService $jobApplicationService
     */

    public function __construct(JobApplicationService $jobApplicationService)
    {
        $this->jobApplicationService = $jobApplicationService;
    }

     /**
     * Applicant status change after final selection
     * @param Array $data
     * @return Response JSON
     */

    public function cvShortListed(array $data)
    {
        $submitted   = Config::get('constants.hrm_status.submitted');
        $shortListed = Config::get('constants.hrm_status.short_listed');

        $applicant = $this->jobApplicationService->findOrFail($data['job_application_id']);

        if ($applicant->status == $shortListed) {
             $applicant->update(['status' => $submitted]);
             $response = trans('job-application.'.$submitted);
        } else {
             $applicant->update(['status' => $shortListed]);
             $response = trans('job-application.'.$shortListed);
        };

        return response()->json($response);
    }
}


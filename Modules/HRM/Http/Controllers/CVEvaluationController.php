<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Services\JobApplicationService;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\JobCircularService;
use phpDocumentor\Reflection\Types\Compound;
use Modules\HRM\Services\CVEvaluationService\CVEvaluationService;

class CVEvaluationController extends Controller
{
    private $jobApplicationService;
    private $jobCircularService;
    private $cvEvaluationService;

    public function __construct(
        JobApplicationService $jobApplicationService,
        JobCircularService $jobCircularService,
        CVEvaluationService $cvEvaluationService
    )
    {
        $this->jobApplicationService = $jobApplicationService;
        $this->jobCircularService = $jobCircularService;
        $this->cvEvaluationService = $cvEvaluationService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $circulars = $this->jobCircularService->findAll();
        $applications = $this->jobApplicationService->findIn('circular_no', $circulars->pluck('id')->toArray());

        return view('hrm::cv-evaluation.index', compact('applications', 'circulars'));
    }

    /**
     * Job Applicant CV Shorlist
     * @param Request $request
     * @return Response JSON
     */


    public function cvShortListed(Request $request)
    {
        return $this->cvEvaluationService->cvShortListed($request->all());
    }

}

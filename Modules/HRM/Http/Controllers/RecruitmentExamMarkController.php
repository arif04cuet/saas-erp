<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use App\Services\JobApplicationService;
use Modules\HRM\Services\JobCircularService;
use Modules\HRM\Services\RecruitmentExamMarkService;

class RecruitmentExamMarkController extends Controller
{
    /**
     * @var $recruitmentExamMarkService
     */

    private $recruitmentExamMarkService;

    /**
     * @var $jobCircularService
     */

    private $jobCircularService;

    /**
     * @param RecruitmentExamMarkService $recruitmentExamMarkService
     * @param JonCircularService $jobCircularService
     * @param JobAplicationService $jobApplicationService
     */


    public function __construct(
        RecruitmentExamMarkService $recruitmentExamMarkService,
        JobCircularService $jobCircularService,
        JobApplicationService $jobApplicationService
    ) {
        $this->recruitmentExamMarkService = $recruitmentExamMarkService;
        $this->jobCircularService = $jobCircularService;
        $this->jobApplicationService = $jobApplicationService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hrm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function recruitMentExamMarks($id)
    {
        $circular = $this->jobCircularService->findOne($id);

        return view('hrm::job-circular.exam.mark', compact('circular'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->recruitmentExamMarkService->storeRecruitmentExamMarks($request->all());

        return redirect()->route('recruitment-exams.index')
                        ->with('success', __('hrm::job-circular.exam_marks.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function recruitmentExamResultShow($id)
    {
        $circular = $this->recruitmentExamMarkService->applicantsResultData($id);

        return view('hrm::job-circular.exam.result-show', compact('circular'));
    }

    /**
     * Applicant status change after final selection
     * @param Request $request
     * @return Response JSON
     */

    public function finalSelectionForRecruitment(Request $request) 
    {
        return $this->recruitmentExamMarkService->finalSelectionForRecruitment($request->all());
    }
}

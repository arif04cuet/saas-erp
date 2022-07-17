<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\JobCircularService;
use Modules\HRM\Services\RecruitmentExamService;

class RecruitmentExamController extends Controller
{
    /**
     * @var RecruitmentExamService
     */
    private $recruitmentExamService;

    /**
     * RecruitmentExamController constructor.
     * @param RecruitmentExamService $recruitmentExamService
     * @param JobCircularService $jobCircularService
     */
    public function __construct(
        RecruitmentExamService $recruitmentExamService
    ) {
        $this->recruitmentExamService = $recruitmentExamService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $exams = $this->recruitmentExamService->findAll(null, ['circular'], ['column' => 'id', 'direction' => 'desc']);
        return view('hrm::job-circular.exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     * @param null $circularId
     * @return \Illuminate\View\View
     */
    public function create($circularId = null)
    {
        $circulars = $this->recruitmentExamService->getCirculars();
        return view('hrm::job-circular.exam.create', compact('circulars', 'circularId'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->recruitmentExamService->store($request->all())) {
            return redirect()->route('recruitment-exams.index')->with('success', __('labels.save_success'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $exam = $this->recruitmentExamService->findOne($id);
        return view('hrm::job-circular.exam.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $exam = $this->recruitmentExamService->findOne($id);
        $circulars = $this->recruitmentExamService->getCirculars(false, $exam->job_circular_id);
        return view('hrm::job-circular.exam.edit', compact('circulars','exam'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if ($this->recruitmentExamService->updateData($request->all(), $id)) {
            return redirect()->route('recruitment-exams.show', $id)
                ->with('success', __('labels.update_success'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

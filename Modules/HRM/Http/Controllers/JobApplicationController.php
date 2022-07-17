<?php

namespace Modules\HRM\Http\Controllers;

use App\Entities\JobApplication;
use App\Services\JobApplicationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\JobCircularService;

class JobApplicationController extends Controller
{
    /**
     * @var JobApplicationService
     */
    private $jobApplicationService;
    /**
     * @var JobCircularService
     */
    private $jobCircularService;

    /**
     * JobApplicationController constructor.
     * @param JobApplicationService $jobApplicationService
     * @param JobCircularService $jobCircularService
     */
    public function __construct(JobApplicationService $jobApplicationService, JobCircularService $jobCircularService)
    {
        /** @var JobApplicationService $jobApplicationService */
        $this->jobApplicationService = $jobApplicationService;
        $this->jobCircularService = $jobCircularService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $circularIds = $this->jobCircularService->findAll()->pluck('id')->toArray();

        $applications = $this->jobApplicationService->findIn('circular_no', $circularIds);

        return view('hrm::job-circular.job-application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hrm::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param JobApplication $jobApplication
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(JobApplication $jobApplication)
    {
        return view('hrm::job-circular.job-application.show' , compact('jobApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hrm::edit');
    }

    /**
     * @param Request $request
     * @param JobApplication $jobApplication
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        if($this->jobApplicationService->storeUpdate($jobApplication, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        }else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->back();
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

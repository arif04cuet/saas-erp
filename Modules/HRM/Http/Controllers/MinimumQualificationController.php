<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\JobCircular;
use Modules\HRM\Services\MinimumQualificationService;

class MinimumQualificationController extends Controller
{

    /**
     * @var MinimumQualificationService
     */
    private $minimumQualificationService;

    public function __construct(MinimumQualificationService $minimumQualificationService)
    {
        /** @var MinimumQualificationService $minimumQualificationService */
        $this->minimumQualificationService = $minimumQualificationService;
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
     * @param JobCircular $jobCircular
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(JobCircular $jobCircular)
    {
        return view('hrm::job-circular.minimum-qualifications.create', compact('jobCircular'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, JobCircular $jobCircular)
    {
        $qualification = $this->minimumQualificationService->store($request->all(), $jobCircular);
        if ($qualification) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('job-circular.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('hrm::show');
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

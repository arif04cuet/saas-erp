<?php

namespace Modules\HRM\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HRM\Entities\JobCircular;
use Modules\HRM\Http\Requests\StoreUpdateJobCircularRequest;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\JobCircularService;

class JobCircularController extends Controller
{
    private $jobCircularService;

    /**
     * @var $designationService
     */

    private $designationService;

    /**
     * @param JobCircularService $jobCircularService
     * @param DesignationService $designationService
     */

    public function __construct(
        JobCircularService $jobCircularService,
        DesignationService $designationService
    ) {
        $this->jobCircularService = $jobCircularService;
        $this->designationService = $designationService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $jobCirculars = $this->jobCircularService->findAll(
            null,
            null,
            ['column' => 'created_at', 'direction' => 'desc']
        );
        return view('hrm::job-circular.index', compact('jobCirculars'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $jobCircularId = $this->jobCircularService->generatJobCircularUniqueId();
        $jobNatures = $this->jobCircularService->getJobNaturesForDropdown();
        $designations = $this->designationService->getDesignationsForDropdown();
        $grades = [__('labels.select')];
        for ($count = 1; $count <= 20; $count++) {
            array_push($grades, "Grade " . $count);
        }

        return view('hrm::job-circular.create', compact('jobCircularId', 'designations', 'grades', 'jobNatures'));
    }


    public function store(Request $request)
    {
        $jobCircular = $this->jobCircularService->store($request->all());
        if ($jobCircular) {
            Session::flash('success', trans('labels.save_success'));
            if ($jobCircular->system_shortlist == 1) {
                return redirect()->route('job-circular.minimum-qualification.create', $jobCircular->id);
            }
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('job-circular.index');
    }

    /**
     * Show the specified resource.
     * @param JobCircular $jobCircular
     * @return Response
     */
    public function show(JobCircular $jobCircular)
    {
        return view('hrm::job-circular.show', compact('jobCircular'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param JobCircular $jobCircular
     * @return Factory|Application|Response|View
     */
    public function edit(JobCircular $jobCircular)
    {
        $designations = $this->designationService->getDesignationsForDropdown();
        $grades = [__('labels.select')];
        $jobNatures = $this->jobCircularService->getJobNaturesForDropdown();
        for ($count = 1; $count <= 20; $count++) {
            array_push($grades, "Grade " . $count);
        }
        return view('hrm::job-circular.edit', compact('jobCircular', 'designations', 'grades', 'jobNatures'));
    }

    /**
     * @param Request $request
     * @param JobCircular $jobCircular
     * @return RedirectResponse
     */
    public function update(Request $request, JobCircular $jobCircular)
    {
        $jobCircular = $this->jobCircularService->updateRequest($jobCircular, $request->all());
        if ($jobCircular) {
            if ($jobCircular->system_shortlist == 1) {
                return redirect()->route('job-circular.minimum-qualification.create', $jobCircular->id);
            }
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('job-circular.index');
    }

    /**
     * @param JobCircular $jobCircular
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(JobCircular $jobCircular)
    {
        $jobCircular->jobCircularDetails()->delete();
        $isDeleted = $jobCircular->delete();
        if ($isDeleted) {

            Session::flash('success', trans('labels.delete_success'));
        } else {
            Session::flash('error', trans('labels.delete_fail'));
        }

        return redirect()->route('job-circular.index');
    }

    public function circularList()
    {
        $jobCirculars = $this->jobCircularService->findAll()
            ->filter(function ($jobCircular) {
                return Carbon::parse($jobCircular->application_deadline)->greaterThanOrEqualTo(Carbon::today());
            });
        return view('hrm::job-circular.public.index', compact('jobCirculars'));
    }
}

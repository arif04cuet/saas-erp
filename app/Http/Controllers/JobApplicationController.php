<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationRequest;
use App\Services\AddressService;
use App\Services\JobApplicationService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HRM\Entities\JobCircular;
use Modules\HRM\Repositories\AcademicInstituteRepository;
use Modules\HRM\Services\JobCircularService;

class JobApplicationController extends Controller
{
    private $jobCircularService;
    private $jobApplicationService;
    private $academicInstituteRepository;
    private $addressService;

    public function __construct(
        JobCircularService $jobCircularService,
        JobApplicationService $jobApplicationService,
        AcademicInstituteRepository $academicInstituteRepository,
        AddressService $addressService
    ) {
        $this->jobCircularService = $jobCircularService;
        $this->jobApplicationService = $jobApplicationService;
        $this->academicInstituteRepository = $academicInstituteRepository;
        $this->addressService = $addressService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $jobApplications = [];
        $allDepartments = [];
        return view('hrm::job-application.index', compact('jobApplications', 'allDepartments'));
    }

    /**
     * @param JobCircular $jobCircular
     * @return Factory|View
     */
    public function create(JobCircular $jobCircular)
    {
        $levels = config('constants.academic_levels');
        $years = range(Carbon::parse()->format('Y'), 1970);
        $passingYears = [];
        foreach ($years as $passingYear) {
            $passingYears[$passingYear] = $passingYear;
        }

        $districts = $this->addressService->getDistricts();
        $photoUrl = '';

        $step = (Session::has('step')) ? Session::get('step') : 0;

        $jobApplicationId = (Session::has('job_application_id')) ? Session::get('job_application_id') : 0;

        $jobCircularDetails = $this->jobCircularService->getDetailsDropdownForJobApplication($jobCircular);

        $maxAgeLimit = $this->jobCircularService->getMaxAgeLimits($jobCircular);


        return view('job-application.create', compact(
                'jobCircular',
                'levels',
                'step',
                'maxAgeLimit',
                'passingYears',
                'districts',
                'jobApplicationId',
                'photoUrl',
                'jobCircularDetails'
            )
        );
    }

    public function getDataByLevel($level)
    {
        $academicExams = config('constants.academic_exams.' . $level);

        $academics = $this->academicInstituteRepository->findAll();

        $institutes = $academics->filter(function ($item) {
            return $item->type == 'university';
        });

        $boards = $academics->filter(function ($item) {
            return $item->type == 'board';
        });

        $data = [
            'exams' => $academicExams,
            'institutes' => $institutes,
            'boards' => $boards
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param JobApplicationRequest $request
     * @param JobCircular $jobCircular
     * @return RedirectResponse|Redirector
     */
    public function store(JobApplicationRequest $request, JobCircular $jobCircular)
    {
            $savedApplication = $this->jobApplicationService->store($request->all());
            if ($savedApplication) {
                Session::flash('success', __('job-application.job_application_complete'));
                Session::put('job_application_id', $savedApplication->id);
                return redirect(route('job-circulars.list'));
            } else {
                Session::flash('error', trans('labels.save_fail'));
                return redirect(route('job-applications.create-public', $jobCircular->id));
            }
    }

    public function getThanasByDisctirctName($districtName)
    {
        return $this->addressService->getThanasByDistrictName($districtName);
    }

}

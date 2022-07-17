<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HRM\Entities\HouseApplication;
use Modules\HRM\Entities\HouseCircular;
use Modules\HRM\Http\Requests\HouseApplicationRequest;
use Modules\HRM\Services\HouseApplicationService;
use Modules\HRM\Services\HouseCircularService;
use Modules\HRM\Services\HouseDetailService;

class HouseApplicationController extends Controller
{
    /**
     * @var $houseApplicationService
     */

    private $houseApplicationService;

    /**
     * @var $houseCircularService
     */

    private $houseCircularService;

    /**
     * @var HouseDetailService
     */
    private $houseDetailService;

    /**
     * @param HouseApplicationService $houseApplicationService
     * @param HouseCircularService $houseCircularService
     * @param HouseDetailService $houseDetailService
     */

    public function __construct(
        HouseApplicationService $houseApplicationService,
        HouseCircularService $houseCircularService,
        HouseDetailService $houseDetailService
    ) {
        $this->houseApplicationService = $houseApplicationService;
        $this->houseCircularService = $houseCircularService;
        $this->houseDetailService = $houseDetailService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index($circularId)
    {
        $circular = $this->houseCircularService->findOne($circularId);
        $houseApplications = $this->houseApplicationService->getHouseApplicationsByCircular($circular);
        return view('hrm::house-circular.house-application.index', compact('circular', 'houseApplications'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|RedirectResponse|Response|View
     */
    public function create($id)
    {
        $canUserApplyForCircular = $this->houseCircularService->canUserApply($this->houseCircularService->findOne($id));
        if ($canUserApplyForCircular['isValid']) {
            Session::flash('error', $canUserApplyForCircular['message']);
            return redirect()->route('house-circulars.index');
        }
        $circularId = $id;
        $houseCircular = $this->houseCircularService->findOne($id);
        $employee = $this->houseApplicationService->prepareEmployeeData();
        $houseDetailDropdown = $this->houseApplicationService->getHouseDetailDropdown($houseCircular);
        return view(
            'hrm::house-circular.house-application.create',
            compact('circularId', 'employee', 'houseDetailDropdown')
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param HouseApplicationRequest $request
     * @return RedirectResponse|Response
     */
    public function store(HouseApplicationRequest $request)
    {
        $canUserApplyForCircular = $this->houseCircularService->canUserApply($this->houseCircularService->findOne($request['house_circular_id']));

        if ($canUserApplyForCircular['isValid']) {
            Session::flash('error', $canUserApplyForCircular['message']);
            return redirect()->route('house-circulars.index');
        }

        if ($this->houseApplicationService->store($request->all())) {
            return redirect()->route('house-circulars.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('house-circulars.index')->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $applicant = $this->houseApplicationService->findOrFail($id);

        return view('hrm::house-circular.house-application.show', compact('applicant'));
    }


    public function applicantSelection(Request $request)
    {
        $applicant = $this->houseApplicationService->findOrFail($request->house_application_id);

        if ($applicant->status == 'submitted') {
            $applicant->update(['status' => 'selected']);
            $status = trans('hrm::house-circular.application.status.selected');
        } else {
            $applicant->update(['status' => 'submitted']);
            $status = trans('hrm::house-circular.application.status.submitted');
        }

        return response()->json($status);
    }

    public function allocateHouseDetails(
        Request $request,
        HouseCircular $houseCircular,
        HouseApplication $houseApplication
    ) {
        if ($houseApplication->employee_id) {
            $alreadyAllocated = $this->houseDetailService->findBy(['allocated_to' => $houseApplication->employee_id])->first();
            if ($alreadyAllocated) {
                return redirect()->route('house-applications.index', $houseCircular)->with('error', __('hrm::house-details.already_allocated', ['house' => $alreadyAllocated->house_id]));
            }
        }

        if ($this->houseApplicationService->allocateHouseDetails($request->all(), $houseApplication)) {
            $this->houseApplicationService->notifyApplicant($request->all(), $houseApplication);
            $message = trans('hrm::circular.flash_messages.house_allocated');
            if (Session::has('success')) {
                $message = Session::get('success');
            }
            return redirect()->route('house-applications.index', $houseCircular)->with(
                'success',
                $message
            );
        } else {
            $message = trans('labels.save_fail');
            if (Session::has('error')) {
                $message = Session::get('error');
            }
            return redirect()->route('house-applications.index', $houseCircular)->with('error', $message);
        }
    }

    public function print(HouseApplication $houseApplication)
    {
        $houseCircular = $houseApplication->houseCircular;
        return view('hrm::house-circular.house-application.print.print', compact('houseApplication', 'houseCircular'));
    }
}

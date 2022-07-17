<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\AppraisalInvitation;
use Modules\HRM\Http\Requests\StoreAppraisalInvitationRequest;
use Modules\HRM\Services\AppraisalInvitationService;
use Modules\HRM\Services\AppraisalSettingService;
use Modules\HRM\Services\EmployeeService;

class AppraisalInvitationController extends Controller
{

    /**
     * @var AppraisalInvitationService
     */
    private $appraisalInvitationService;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var AppraisalSettingService
     */
    private $appraisalSettingService;

    public function __construct(
        AppraisalInvitationService $appraisalInvitationService,
        EmployeeService $employeeService,
        AppraisalSettingService $appraisalSettingService
    )
    {
        /** @var AppraisalInvitationService $appraisalInvitationService */
        $this->appraisalInvitationService = $appraisalInvitationService;
        /** @var EmployeeService $employeeService */
        $this->employeeService = $employeeService;
        /** @var AppraisalSettingService $appraisalSettingService */
        $this->appraisalSettingService = $appraisalSettingService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $invitations = $this->appraisalInvitationService->findAll(null, null, ['column' => 'id', 'direction' => 'desc']);
        return view('hrm::appraisal.invitation.index', compact('invitations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $memorandum_no = $this->appraisalInvitationService->getMemorandumNumber();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $reporters = $this->appraisalSettingService->getReporterFromAppraisalSettings();
        return view('hrm::appraisal.invitation.create', compact('memorandum_no', 'employees', 'reporters'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreAppraisalInvitationRequest $request)
    {
        $invitation = $this->appraisalInvitationService->storeInvitation($request->all());
        if ($invitation) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('appraisal.invitation.index');
    }

    /**
     * Show the specified resource.
     * @param AppraisalInvitation $appraisalInvitation
     * @return Response
     */
    public function show(AppraisalInvitation $appraisalInvitation)
    {
        return view('hrm::appraisal.invitation.show', compact('appraisalInvitation'));
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
